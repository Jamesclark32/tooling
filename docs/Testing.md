## Testing

Prefer Pest over PHPUnit.

A robust test suite should be able to accurately quantify the health of the application across many measures.

Packages:

`composer require pestphp/pest pestphp/pest-plugin-laravel pestphp/pest-plugin-type-coverage --dev`

### Test Categories

---

#### Unit Tests

https://pestphp.com/docs/writing-tests
 
- Test small, isolated code units.
- Scoped to a single method or class.
- In general, don't use a lot of unit tests and prefer feature tests. Unit tests tend to more fragile, requiring more frequent updating as the codebase itself changes, with little benefit over a robust feature test suite.
- I currently only use unit testing on models, I consider this double-entry accounting style verification of attribute lists and sanity checks of relationships.


<details>
<summary>Example</summary> 

A Model test, which ensures the Link model has the expected attributes and relationships:

```php
<?php

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

test('to array', function () {

    $instance = App\Models\Link::factory()->create()->refresh();

    expect(array_keys($instance->toArray()))
        ->toBe([
            'id',
            'uuid',
            'user_id',
            'link_group_id',
            'slug',
            'name',
            'url',
            'sequence',
            'created_at',
            'updated_at',
        ]);
});

test('relations', function () {

    $instance = App\Models\Link::factory()->create()->refresh();

    expect($instance->linkGroup)->toBeInstanceOf(App\Models\LinkGroup::class);
});
```

</details>

--- 

#### Feature Tests

https://pestphp.com/docs/writing-tests

- Tests for the full scope of a specific feature, including all code executed as a part of it.
- Should compose the majority of the test suite.
- Generally align with a controller, job, or console command.
- Often tests web-based user interfaces despite lacking JavaScript/frontend runtime.
- One file per endpoint/job/command with many tests.
- Test the happy path as well as edge cases.
- Avoid testing specific validation rules.
- Write tests that fail clearly. Consider the highest-level ways things might break and put tests for those issues first.
- Test complexity and coverage complexity are indicators of code health; if code is hard to test, it will also be hard to use and maintain going forward.


<details>
<summary>Example</summary> 

A set of tests against an update endpoint for a LinkGroup model

```php
<?php

namespace Tests\Feature\Http\Controllers\Ajax\LinkGroup\Link\Sequence;

use App\Models\Link;
use App\Models\LinkGroup;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_200(): void
    {
        $user = User::factory()->create();

        $linkGroup = LinkGroup::factory()->create([
            'user_id' => $user->id,
        ])->fresh();

        $link = Link::factory()->create([
            'user_id' => $user->id,
        ]);

        $response = $this
            ->actingAs($user)
            ->put(
                route('ajax.link-groups.links.sequence', ['linkGroup' => $linkGroup->uuid]),
                [
                    'links' => [
                        0 => $link->uuid,
                    ],
                ]
            );

        $response->assertStatus(200);
    }

    public function test_returns_302_when_unauthorized(): void
    {
        $user = User::factory()->create();

        $linkGroup = LinkGroup::factory()->create([
            'user_id' => $user->id,
        ])->fresh();

        $link = Link::factory()->create([
            'user_id' => $user->id,
        ]);

        $response = $this
            ->put(
                route('ajax.link-groups.links.sequence', ['linkGroup' => $linkGroup->uuid]),
                [
                    'links' => [
                        0 => $link->uuid,
                    ],
                ]
            );

        $response->assertStatus(302);
    }

    public function test_updates_link(): void
    {
        $user = User::factory()->create();

        $linkGroup = LinkGroup::factory()->create([
            'user_id' => $user->id,
        ])->fresh();

        $linkOne = Link::factory()->create([
            'user_id' => $user->id,
            'sequence' => 10,
        ]);

        $linkTwo = Link::factory()->create([
            'user_id' => $user->id,
            'sequence' => 20,
        ]);

        $response = $this
            ->actingAs($user)
            ->put(
                route('ajax.link-groups.links.sequence', ['linkGroup' => $linkGroup->uuid]),
                [
                    'links' => [
                        0 => $linkTwo->uuid,
                        1 => $linkOne->uuid,
                    ],
                ]
            );

        $response->assertStatus(200);

        $this->assertDatabaseHas('links', [
            'uuid' => $linkOne->uuid,
            'name' => $linkOne->name,
            'user_id' => $user->id,
            'sequence' => 1,
        ]);
        $this->assertDatabaseHas('links', [
            'uuid' => $linkTwo->uuid,
            'name' => $linkTwo->name,
            'user_id' => $user->id,
            'sequence' => 0,
        ]);
    }

    public function test_links_are_required(): void
    {
        $user = User::factory()->create();

        $linkGroup = LinkGroup::factory()->create([
            'user_id' => $user->id,
        ])->fresh();

        $linkOne = Link::factory()->create([
            'user_id' => $user->id,
            'sequence' => 10,
        ]);

        $linkTwo = Link::factory()->create([
            'user_id' => $user->id,
            'sequence' => 20,
        ]);

        $response = $this
            ->actingAs($user)
            ->put(
                route('ajax.link-groups.links.sequence', ['linkGroup' => $linkGroup->uuid]),
                [
                    'links' => [
                        //
                    ],
                ]
            );

        $response->assertStatus(302);

        $this->assertDatabaseMissing('links', [
            'uuid' => $linkOne->uuid,
            'name' => $linkOne->name,
            'user_id' => $user->id,
            'sequence' => 1,
        ]);
        $this->assertDatabaseHas('links', [
            'uuid' => $linkOne->uuid,
            'name' => $linkOne->name,
            'user_id' => $user->id,
            'sequence' => 10,
        ]);
    }
}
```

</details>

--- 

#### Architecture Tests

https://pestphp.com/docs/arch-testing 

- Tests for compliance to architecture rules.
- Enforces consistency throughout the codebase.
- Often aligns with app/* folders, such as Models, Console/Commands, and Jobs.


<details>
<summary>Example</summary> 

An architectural test for the contents of app/Http/Controllers

```php
<?php

use App\Http\Controllers\Controller;

arch('controllers')
    ->expect('App\Http\Controllers')
    ->toHaveSuffix('Controller')
    ->toBeClasses()
    ->toBeFinal()
    ->ignoring([
        Controller::class,
    ])
    ->toImplementNothing()
    ->toExtend(Controller::class)
    ->toBeInvokable();
```

</details>


--- 

#### Measuring Code Coverage

- When using Pest, the test suite can be run using `--coverage` to see gaps in test coverage.
- In the real world, ~70–80% coverage is considered healthy. 100 is generally unrealistic.
- You should be striving for 100 and should be aware of the complexities preventing coverage for exceptions.

---

#### Also consider

- Browser tests https://pestphp.com/docs/browser-testing
- Stress tests https://pestphp.com/docs/stress-testing
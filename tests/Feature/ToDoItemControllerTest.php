<?php

namespace Tests\Feature;

use App\Models\ToDoItem;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ToDoItemControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_todoitems_list_visit()
    {
        /** @var Authenticatable $user */
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get('/todoitems');
        $response->assertStatus(200);
        $response->assertViewIs('todoitems.index');
    }

    public function test_we_can_visit_todoitems_create()
    {
        /** @var Authenticatable $user */
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/todoitems/create');
        $response->assertStatus(200);
        $response->assertViewIs('todoitems.create');
    }

    public function test_we_can_add_new_todoitem()
    {
        /** @var Authenticatable $user */
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->followingRedirects();

        $response = $this->post(route('todoitems.store'), [
            'user_id' => $user->id,
            'title' => 'new task'
        ]);

        $this->assertDatabaseHas('to_do_items', [
            'user_id' => $user->id,
            'title' => 'new task'
        ]);

        $response->assertStatus(200);
    }

    public function test_we_can_access_todoitem_edit_view()
    {
        /** @var Authenticatable $user */
        $user = User::factory()->create();
        $this->actingAs($user);

        $toDoItem = ToDoItem::factory()->create([
            'user_id' => 1
        ]);

        $response = $this->get(route('todoitems.edit', $toDoItem));

        $response->assertStatus(200);
        $response->assertViewIs('todoitems.edit');
    }

    public function test_we_can_edit_todoitem()
    {
        /** @var Authenticatable $user */
        $user = User::factory()->create();
        $this->actingAs($user);

        $task = ToDoItem::factory()->create([
            'user_id' => $user->id
        ]);

        $this->followingRedirects();
        $response = $this->put(route('todoitems.update', $task), [
            'title' => 'new task 1',
        ]);

        $this->assertDatabaseHas('to_do_items', [
            'user_id' => $user->id,
            'title' => 'new task 1',
        ]);
        $response->assertStatus(200);
    }

    public function test_we_can_delete_todoitem()
    {
        /** @var Authenticatable $user */
        $user = User::factory()->create();
        $this->actingAs($user);

        $task = ToDoItem::factory()->create([
            'user_id' => $user->id
        ]);

        $this->followingRedirects();
        $response = $this->delete(route('todoitems.destroy', $task));

        $this->assertDatabaseMissing('to_do_items', [
            'id' => $task->id
        ]);

        $response->assertStatus(200);
    }
}

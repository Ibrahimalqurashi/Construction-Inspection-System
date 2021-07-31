<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use app\Http\Controllers\Auth;
use AuthenticatesUsers;
use App\User;
use App\Projects;

class ProjectsTest extends TestCase
{
    use RefreshDatabase;

    public function test_only_logged_in_users_can_view_projects(){

        $response =$this->get('/projects')
            ->assertRedirect('/login');
    }

    public function test_validated_user_can_view_projects(){

        $this->actingAs(factory(User::class)->create());

        $response =$this->get('/projects')
            ->assertOk();
        
    }

    public function test_creating_project(){


        $this->actingAs(factory(User::class)->create());

        $user = auth()->user();

        $response = $this->post('/projects', array_merge($this->data(), ['managerID' => $user->id]));

        $this->assertCount(1, Projects::all());

        $response =$this->get('/projects/1')
            ->assertOk();

        
        $project = Projects::findOrFail(1);

        $this->assertEquals($user->id, $project->managerID);

    }

    public function test_if_name_is_reqired(){
        
        $this->actingAs(factory(User::class)->create());

        $user = auth()->user();

        $response = $this->post('/projects', array_merge($this->data(), ['managerID' => $user->id, 'name' => '']));

        $this->assertCount(0, Projects::all());
    }

    private function data(){
        return [
            'name' => 'Test User',
            'sponsorName' => 'Test Sponser',
        ];
    }
}

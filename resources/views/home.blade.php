@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">




                <div class="row">
                    <div class="col-md-4">
                        <h3>Translations</h3>
                        <a href="/home/translations">Translations</a><br>

                    </div>
                    <div class="col-md-4">
                        <h3>Blog</h3>
                        <a href="/home/blog/add">Add New Blog</a><br>
                        <a href="/home/blog/list">Edit Blog</a><br>
                    </div>
                    <div class="col-md-4">
                       <h3>Cards</h3>
                        <a href="/home/card/add">Add New Card</a><br>
                        <a href="">Edit Card</a><br>                   
                    </div>                                        
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <h3>Event Data</h3>
                        <a href="/home/event/data">Add Event Data</a><br>
                    </div>
                    <div class="col-md-4">
                       <!-- <h3>Messages</h3>
                        <a href="/home/messages">View Messages</a><br>
                        <a href="/home/message/new">Create New Message</a><br>-->
                    </div>                     
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Data</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h3>Users</h3>
                            <strong>{{$userstotal}}</strong> Total Users<br>
                            <strong>{{$usersweek}}</strong> Users This Week<br>
                            <strong>{{$userstoday}}</strong> Users Today

                        </div>
                        <div class="col-md-4">
                        <h3>To Check</h3>
                            <strong>{{$suggestions}}</strong> <a href="/home/suggestions">Card Suggestions</a><br>                
                            <strong>{{$issues}}</strong> <a href="/home/cardissues">Card Issues</a><br>  
                            <strong>{{$messages}}</strong> <a href="/home/messages">Messages</a><br>                                           
                        </div>  
                    </div>
                </div>
            </div>
        </div>    
    </div>
</div>
@endsection

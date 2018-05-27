@extends('site.template.main')
@section('content')
<br>
<br><br>
<br><br><br>

{{-- <div id="chat">
</div> --}}

<div class="card mb-4 box-shadow">   
        <div class="row">
            <div class="col-md-4 current-chat-area">
                <div class="chat-search">
                    <input class="form-control" type="text" placeholder="Buscar un usuario..." v-model="first_name" v-on:click="getUsers">   
                </div>
                <template v-if="first_name!=''">
                    <h3>Busqueda</h3>
                    <ul class="list-group">                    
                        <li v-for="user in searchUser" class="list-group-item" v-on:click="getChats(user.id)">
                            <img :src="user.image" :alt="user.first_name">
                            <span>{{user.first_name}}</span>
                        </li>
                    </ul>  
                </template>     
                <h3>Chats</h3>          
                <ul class="list-group">                
                    <li v-for="(contact, index) in contacts" class="list-group-item" v-on:click="getChats(contact.id)">
                        <img :src="contact.image" :alt="contact.name">
                        <span>{{contact.name}}</span>
                    </li>
                </ul>      
            </div>
            <div class="col-md-8 current-chat">
                <template v-if="userChat.length > 0">
                    <div class="current-chat-header">
                        <span v-for="(r, index) in receiver" :value="r.id">{{r.first_name}}</span>
                    </div>
                    <div class="current-chat-area">
                        <ul v-for="(message, index) in userChat" class="media-list ">
                            <li class="media">
                                <div class="media-body">
                                    <div class="media">
                                        <a class="pull-left" href="#" style="padding-right: 10px">
                                            <img class="media-object img-circle " :src="message.user.image" width="50px">
                                        </a>
                                        <div class="media-body">
                                            <span class="label label-warning">{{message.content}}</span>
                                            <br>
                                           <small class="text-muted">{{message.user.username }} | {{message.created_at }}</small>
                                            <hr>
                                        </div>
                                    </div>        
                                </div>
                            </li>
                        </ul>  
                    </div>
                    <div class="current-chat-footer">
                        <form class="form-horizontal" v-on:submit.prevent="sendMessage()" style="width: 100%;">
                            <div class="input-group">
                                <input v-for="(rec, index) in receiver" type="hidden" class="form-control" >
                                <input style="width: 680px;" type="text" class="form-control" v-model="createMessage" placeholder="Escribe un mensaje..." required="required">
                                <button class="btn btn-sm btn-info" type="submit" >
                                    <i class="icon dripicons-direction"></i>
                                </button>
                            </div>
                        </form>      
                    </div>
                </template>
                <template v-else>
                    <div class="current-chat-header">
                        <span >Seleccione un chat...</span>
                    </div>
                </template>
            </div>
        </div>
    </div>
<script src="{{mix('js/app.js')}}" ></script>
  
@endsection
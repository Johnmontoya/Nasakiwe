@extends('menus.layout')
@section('content')
    @if(Auth::check())
        @if(Auth::user()->id_rol == 1)
            <template v-if="menu==0">
                <dashboard></dashboard>
            </template>
            <template v-if="menu==1">
                <usuarios></usuarios>
            </template>
            <template v-if="menu==2">
                <roles></roles>
            </template>
            <template v-if="menu==3">
                <politica></politica>
            </template>
        @elseif(Auth::user()->id_rol == 2)
            <template v-if="menu==0">
                <dashboard_usuario></dashboard_usuario>
            </template>            
            <template v-if="menu==11">
                <perfil></perfil>
            </template>
        @else
        @endif
    @endif
@endsection

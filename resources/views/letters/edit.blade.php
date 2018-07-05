@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Letter
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($letter, ['route' => ['letters.update', $letter->id], 'method' => 'patch']) !!}

                        @include('letters.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
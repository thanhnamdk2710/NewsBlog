@extends('layouts.master')
@section('Content')
    <?php $khoahoc = array('PHP', 'IOS', 'JAVA') ?>
    @foreach($khoahoc as $value)
        {{$value}}
    @endforeach
@endsection
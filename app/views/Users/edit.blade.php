@extends('layouts.transaction')

@section('title')  BILLING @stop

@section('mandatory-transaction')
            <pre>
                <label class="label">*Mandatory transction</label>    <input type="text" id="prod" placeholder="productID" class="prod-text-card">  <input type="text" placeholder="quantity" class="qty-text-card"> 
            </pre>
@stop

@section('other-transactions')
    <input type="button" class="button-card" value="SUBMIT" id="submitData"> <span float="right";><input type="button" class= "button-card" id="insertRecord"value="INSERT"></span>
    </pre>
    <a class="logout-button" href="http://localhost:8000" >LOGOUT</a>
@stop
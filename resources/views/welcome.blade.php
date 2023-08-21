<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<x-layout styleLink='css/homepage.css'>
    @if(session()->has('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Thank you.</strong> We received your message.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <section>
        <div class="d-flex justify-content-center"><img src="/images/AMR-PC-yellow-1-min.png" alt="amr logo"></div>
        <p>Welcome to AMR Project Consultancy</p>
        <p>
            You are a Government or a Multinational Organisation <br>
            You are facing Security Challenges <br>
            You want independent vetting of your existing Security Architecture / Structure <br>
            You are looking for Solutions to Security Challenges
        </p>
        <h2>
            YOU ARE AT THE RIGHT PLACE
        </h2>
        <p>
            <a href="/contact">Click here</a> to fill and send our Contact Form, we will contact you!
        </p>
    </section>
</x-layout>
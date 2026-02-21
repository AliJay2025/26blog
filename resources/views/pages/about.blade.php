@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">About Us</h1>
    
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <p class="text-lg mb-4">A blog website built with Laravel that lets users share ideas and connect with readers.</p>
        
        <h2 class="text-xl font-semibold mt-4 mb-3">Features:</h2>
        <ul class="list-disc pl-5 mb-4 space-y-1">
            <li>Browse and read blog posts</li>
            <li>Register/login to write your own posts</li>
            <li>Create, edit, and delete posts (CRUD operations)</li>
            <li>Leave comments on posts</li>
            <li>Upload images with your posts</li>
            <li>About and Contact pages</li>
        </ul>
        
        <h2 class="text-xl font-semibold mt-4 mb-3">What I Learned:</h2>
        <ul class="list-disc pl-5 space-y-1">
            <li>Building database tables for posts and comments</li>
            <li>Adding user registration and login</li>
            <li>Creating comment systems for reader interaction</li>
            <li>Making pages look good with custom styling</li>
            <li>Organizing code to keep it clean and simple</li>
        </ul>
    </div>
</div>
@endsection
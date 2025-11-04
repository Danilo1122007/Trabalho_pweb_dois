<!DOCTYPE html>

<html>

<head>

    <title>Hi</title>

</head>

<body>

    <h1>Welcome to ItSolutionStuff.com - {{ $title }}</h1>

    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod

    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,

    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo

    consequat.</p>

  

    <br/>

    <strong>Public Folder:</strong>

    <img src="{{ public_path('dummy.jpg') }}" style="width: 200px; height: 200px">

  

    <br/>

    <strong>Storage Folder:</strong>

    <img src="{{ storage_path('app/public/dummy.jpg') }}" style="width: 200px; height: 200px">

</body>

</html>
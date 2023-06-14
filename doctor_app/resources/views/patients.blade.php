{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
</x-app-layout> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="collapse" id="navbarToggleExternalContent">
        <div class="bg-dark p-4">
          <h5 class="text-white h4">{{$doctorName}}</h5>
        <a href="{{route('dashboard')}}"> <span class="text-muted">Dashboard</span></a> 
        </div>
      </div>
      <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </nav>

<div class="container pt-4">
   
<div class="row">
<div class="col-md-6">
    <div class="card">
        <h5 class="card-header">Icoming Patients</h5>
        <div class="card-body">
          
    <table class="table">
       
        
          @if (count($incomAppointments)>0)
          <thead>
       
            
         
            <tr>
              
              <th scope="col">#</th>
              <th scope="col">Full Name</th>
              <th scope="col">Date</th>
              <th scope="col">Status</th>
              <th scope="col">Action</th>
            </tr>
  
          </thead>
          <tbody>
            @foreach ($incomAppointments as $key  =>$incoming)
            <tr>
              <th scope="row">{{$key+1}}</th>
              <td>{{$incoming->name}}</td>
              <td>{{$incoming->created_at}}</td>
              <td>{{$incoming->status}}</td>
              <td><a href="#">Edit</a></td>
            </tr>
            @endforeach
       
          @else
          <p>There is no Incoming Patient yet</p>
            
          @endif
        </tbody>  
       
      </table>
    </div>
</div>
    </div>

<div class="col-md-6">
    <div class="card">
        <h5 class="card-header">Completed Patients</h5>
        <div class="card-body">
          <table class="table">
            @if (count($incomAppointments)>0)
            <thead>
         
              
           
              <tr>
                
                <th scope="col">#</th>
                <th scope="col">Full Name</th>
                <th scope="col">Date</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
    
            </thead>
            <tbody>
              @foreach ($completeAppointments as $key  =>$completed)
              <tr>
                <th scope="row">{{$key+1}}</th>
                <td>{{$completed->name}}</td>
                <td>{{$completed->created_at}}</td>
                <td>{{$completed->status}}</td>
                <td><a href="#">Edit</a></td>
              </tr>
              @endforeach
         
            @else
            <p>There is no Completed Patient yet</p>
              
            @endif
          </tbody>  
          </table>
        </div>
        </div>
      </div>
</div>
</div>

</div>
</body>
</html>

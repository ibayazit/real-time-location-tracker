<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{config('app.name')}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>
    <div class="container py-5" id="app">
        <div class="row">
            <div class="col-sm-6 py-2" v-for="car in cars" :key="car.id">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <h3 class="card-title text-center">@{{car.name}}</h3>
                        <span class="badge bg-success p-3">Lat: @{{car.location.latitude}}</span>
                        <span class="badge bg-success p-3">Long: @{{car.location.longitude}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/vue@3"></script>
    <script src="https://cdn.socket.io/4.5.0/socket.io.min.js" integrity="sha384-7EyYLQZgWBi67fBtVxw60/OWl1kjsfrPFcaU0pp0nAh+i8FD068QogUvg85Ewy1k" crossorigin="anonymous"></script>

    <script>
        const { createApp } = Vue

        createApp({
            data() {
                return {
                    cars: []
                }
            },
            mounted(){
                const cars = this.cars;
                const socket = io('http://localhost:3000');
                // const socket = io('http://192.168.148.170:3000');
                
                socket.on("private-location:location", function(data){
                    if(cars.find(c => c.id == data.message.id)){
                        cars.find(c => c.id == data.message.id).location = data.message.location
                    }
                    else{
                        cars.push(data.message)
                    }
                });
            },
        }).mount('#app')
    </script>
  </body>
</html>
@extends('layouts.index') @section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">EDIT E-Warong</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item active">E-Warong</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                @if ($error_message)
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{$error_message}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                @endif
                <form method="POST" action="{{ Route('ewarong.update', $rpk->id) }}" enctype="multipart/form-data"
                    onkeydown="return event.key != 'Enter';">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="form-body">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Nama Kios</label>
                                <input type="text" name="nama_kios" class="form-control" value="{{$rpk->nama_kios}}">
                                    {{-- <small class="form-control-feedback"> This is inline help </small> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Telephone</label>
                                    <input type="number" name="telp" class="form-control" value="{{$rpk->telp}}" maxlength="10">
                                    {{-- <small class="form-control-feedback"> This is inline help </small> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Jam Buka</label>
                                    <input type="text" class="form-control" value="{{$rpk->jam_buka}}"
                                        name="jam_buka" id="timePicker1" />
                                    {{-- <small class="form-control-feedback"> This is inline help </small> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Jam Tutup</label>
                                    <input type="text" class="form-control" value="{{$rpk->jam_tutup}}"
                                        name="jam_tutup" id="timePicker4" />
                                    {{-- <small class="form-control-feedback"> This is inline help </small> --}}
                                </div>
                            </div>
                        </div>
                        @if (auth()->user()->access_type ==='superadmin')
                        <h3 class="card-title" style="font-weight: bold">Pemilik Kios</h3>
                        <hr>
                        <div class="row" style="margin-bottom:20px">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">User</label>
                                    <select class="form-control" name="user_id" custom-select">
                                        @foreach ($users as $user)
                                        <option value="{{$user->id}}" {{$rpk->user_id == $user->id ? 'selected': null}}>{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        @else 
                        <input type="hidden" name="user_id" value="{{$rpk->user_id}}" />
                        @endif
                        <h3 class="card-title" style="font-weight: bold">Kecamatan dan Kelurahan</h3>
                        <hr>
                        <div class="row" style="margin-bottom:20px">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Kecamatan</label>
                                    <select class="select2 form-control" name="district_id" custom-select">
                                        @foreach ($districts as $district)
                                        <option value="{{$district->id}}" {{$rpk->district_id == $district->id ? 'selected':null}}>{{$district->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Kelurahan</label>
                                    <select class="select2 form-control" name="village_id" custom-select">
                                        @foreach ($villages as $village)
                                        <option value="{{$village->id}}" {{$rpk->village_id == $village->id ? 'selected':null}}>{{$village->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <h3 class="card-title" style="font-weight: bold">Maps</h3>
                        <hr>
                        <div class="row" style="margin-bottom:20px">
                            <div class="col-3">
                            <input type="text" placeholder="langitude" class="form-control" name="latitude" value="{{$rpk->latitude}}"
                                    id="langitude">
                            </div>
                            <div class="col-3">
                                <input type="text" placeholder="longitude" class="form-control" name="longitude" value="{{$rpk->longitude}}"
                                id="longitude">
                            </div>
                              <div class="col-6">
                                                <input type="text" name="lokasi" class="form-control" value="{{$rpk->lokasi}}" placeholder="lokasi">
                                                {{-- <small class="form-control-feedback"> This is inline help </small> --}}
                             </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <input id="pac-input" class="controls" type="text" placeholder="Cari Alamat">
                                <div id="mapGoogle" style="height: 500px;"></div>
                            </div>
                        </div>
                        {{-- <h3 class="card-title" style="font-weight: bold; margin-top: 20px;">Foto</h3>
                        <hr>
                        <div class="row">
                            <div class="col-lg-5 col-md-5">
                                <div class="card">
                                    <div class="card-body" style="text-align: center !important;">
                                        <input type="file" name="image_url" id="input-file-now" class="dropify" />
                                    </div>
                                </div>
                            </div>
                        </div> --}}


                        <div class="form-actions" style="margin-top:20px">
                        </div> <button type="submit" class="btn btn-success">
                            <i class="fa fa-check"></i> Save</button>
                        <a href="{{url('/ewarong')}}" class="btn btn-inverse">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function initAutocomplete() {

        var location = {
            lat:{{$rpk->latitude ? $rpk->latitude : 7.4142711}},
            lng:{{$rpk->longitude ? $rpk->longitude : 112.5304693}} ,
        };

        var map = new google.maps.Map(document.getElementById('mapGoogle'), {
            center: location,
            zoom: 12,
            mapTypeId: 'roadmap'
        });

        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function () {
            searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        searchBox.addListener('places_changed', function () {
            var places = searchBox.getPlaces();
            document.getElementById("langitude").value = places[0].geometry.location.lat();
            document.getElementById("longitude").value = places[0].geometry.location.lng();
            if (places.length == 0) {
                return;
            }
            // Clear out the old markers.
            markers.forEach(function (marker) {
                marker.setMap(null);
            });
            markers = [];

            // For each place, get the icon, name and location.
            var bounds = new google.maps.LatLngBounds();
            places.forEach(function (place) {
                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                var icon = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25)
                };

                // Create a marker for each place.
                markers.push(new google.maps.Marker({
                    map: map,
                    icon: icon,
                    title: place.name,
                    position: place.geometry.location
                }));

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });
            map.fitBounds(bounds);
        });
    }
</script>
@endsection
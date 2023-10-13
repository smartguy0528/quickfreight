@extends('frontendlayouts.app')

@section('content')
    @include('frontendlayouts.navbar')

    <main>
        <!-- Hero Start -->
        <div class="slider-area2">
            <div class="slider-height2 d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap hero-cap2 text-center pt-70">
                                <h2 id="services">Our Services</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero End -->
        <!-- Order Form Start -->
        <section class="order-form-main">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-wrapper">
                            <!--Section Title  -->
                            <div class="form-tittle">
                                <div class="row ">
                                    <div class="col-lg-11 col-md-10 col-sm-10">
                                        <div class="section-tittle">
                                            <span>Place Order</span>
                                            <h2>Place Order Now</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Order Form  -->
                            <form method="GET" id="orderForm" action="{{route('quote.request')}}" class="form-order contact_form pl-65 pr-65 pt-30 pb-30">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="firstName">First Name <span class="text-danger">*</span></label>
                                            <input id="firstName" name="firstName" class="form-control" value="{{ old('firstName') }}">
                                            @if($errors->has('firstName'))
                                                <small class="text-danger">{{ $errors->first('firstName') }}</small>
                                                <input type="hidden" class="errorMsg" value="{{$errors->first('firstName')}}">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="lastName">Last Name <span class="text-danger">*</span></label>
                                            <input id="lastName" name="lastName" class="form-control" value="{{ old('lastName') }}">
                                            @if($errors->has('lastName'))
                                                <small class="text-danger">{{ $errors->first('lastName') }}</small>
                                                <input type="hidden" class="errorMsg" value="{{$errors->first('lastName')}}">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email">Email <span class="text-danger">*</span></label>
                                            <input name="email" id="email" class="form-control" value="{{ old('email') }}">
                                            @if($errors->has('email'))
                                                <small class="text-danger">{{ $errors->first('email') }}</small>
                                                <input type="hidden" class="errorMsg" value="{{$errors->first('email')}}">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="phone">Phone <span class="text-danger">*</span></label>
                                            <input id="phone" name="phone" class="form-control" value="{{ old('phone') }}">
                                            @if($errors->has('phone'))
                                                <small class="text-danger">{{ $errors->first('phone') }}</small>
                                                <input type="hidden" class="errorMsg" value="{{$errors->first('phone')}}">
                                            @endif
                                        </div>
                                    </div>
                                    <!-- <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="pickup">Pickup City / State <span class="text-danger">*</span></label>
                                            <input id="pickup" name="pickup" class="form-control" value="{{ old('pickup') }}">
                                            @if($errors->has('pickup'))
                                                <small class="text-danger">{{ $errors->first('pickup') }}</small>
                                                <input type="hidden" class="errorMsg" value="{{$errors->first('pickup')}}">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="delivery">Delivery City / State <span class="text-danger">*</span></label>
                                            <input id="delivery" class="form-control" type="text" name="delivery" value="{{ old('delivery') }}">
                                            @if($errors->has('delivery'))
                                                <small class="text-danger">{{ $errors->first('delivery') }}</small>
                                                <input type="hidden" class="errorMsg" value="{{$errors->first('delivery')}}">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="pickupDate">Pickup Date <span class="text-danger">*</span></label>
                                            <input type="text" id="pickupDate" class="form-control" name="pickupDate" onblur="(this.type='text')" onfocus="(this.type='date')" value="{{ old('pickupDate') }}">
                                            @if($errors->has('pickupDate'))
                                                <small class="text-danger">{{ $errors->first('pickupDate') }}</small>
                                                <input type="hidden" class="errorMsg" value="{{$errors->first('pickupDate')}}">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="deliveryDate">Delivery Date <span class="text-danger">*</span></label>
                                            <input type="text" id="deliveryDate" class="form-control" name="deliveryDate" onblur="(this.type='text')" onfocus="(this.type='date')" value="{{ old('deliveryDate') }}">
                                            @if($errors->has('deliveryDate'))
                                                <small class="text-danger">{{ $errors->first('deliveryDate') }}</small>
                                                <input type="hidden" class="errorMsg" value="{{$errors->first('deliveryDate')}}">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="commodity">Commodity <span class="text-danger">*</span></label>
                                            <input id="commodity" class="form-control" type="text" name="commodity" value="{{ old('commodity') }}">
                                            @if($errors->has('commodity'))
                                                <small class="text-danger">{{ $errors->first('commodity') }}</small>
                                                <input type="hidden" class="errorMsg" value="{{$errors->first('commodity')}}">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="dimension">Dimension</label>
                                            <input id="dimension" class="form-control" type="text" name="dimension" value="{{ old('dimension') }}">
                                            @if($errors->has('dimension'))
                                                <small class="text-danger">{{ $errors->first('dimension') }}</small>
                                                <input type="hidden" class="errorMsg" value="{{$errors->first('dimension')}}">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="weight">Weight</label>
                                            <input id="weight" class="form-control" type="text" name="weight" value="{{ old('weight') }}">
                                            @if($errors->has('weight'))
                                                <small class="text-danger">{{ $errors->first('weight') }}</small>
                                                <input type="hidden" class="errorMsg" value="{{$errors->first('weight')}}">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="temperature">Temperature Condition</label>
                                            <input id="temperature" class="form-control" type="text" name="temperature" value="{{ old('temperature') }}">
                                            @if($errors->has('temperature'))
                                                <small class="text-danger">{{ $errors->first('temperature') }}</small>
                                                <input type="hidden" class="errorMsg" value="{{$errors->first('temperature')}}">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-30">
                                        <div class="form-group">
                                            <label for="equipment">Equipment</label>
                                            <select class="form-control w-100" name="equipment" id="equipment">
                                                @foreach($equipments as $equipment)
                                                <option value="{{$equipment->equipmentId}}">{{$equipment->equipmentName}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-30">
                                        <div class="form-group">
                                            <label for="trailerSize">Trailer Size</label>
                                            <select class="form-control w-100" name="trailerSize" id="trailerSize">
                                                @foreach($trailer_size as $trailer)
                                                <option value="{{$trailer->trailerSizeId}}">{{$trailer->trailerSizeName}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> -->
                                    <!-- <div  class="col-sm-12">
                                        <div id="table" class="table-editable">
                                            <div class="table-responsive">                                                                                
                                                <table id="serviceTable" class="table">
                                                    <tr>
                                                        <th>Location</th>
                                                        <th>Commodify</th>
                                                        <th>Dimension</th>
                                                        <th>Load/Unload</th>
                                                    </tr>
                                                    <tr>
                                                        <td width='35%' align='center' type='text' contenteditable='true' id='location' name='location'></td>
                                                        <td width='25%' align='center' type='text' contenteditable='true' id='commodity' type='text' name='commodity'></td>
                                                        <td width='25%' align='center' type='text' contenteditable='true' id='dimension' type='text' name='dimension'></td>
                                                        <td width='15%' align='center' id='hold/unhold' name='hold/unhold'>
                                                            <button type='button' class='selectLoadBtn' value='1'>Load</button>
                                                        </td>
                                                    </tr>                                           
                                                </table>
                                            </div>
                                        </div>
                                        <br>
                                        <button id="addTableContent" class='selectLoadBtn' type="button"  style="border-radius:5px; background-color:red">Add</button>
                                    </div> -->
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="location">Location</label>
                                                <input id="location" class="form-control" type="text" name="location1" value="{{ old('location') }}">
                                                @if($errors->has('location'))
                                                    <small class="text-danger">{{ $errors->first('location') }}</small>
                                                    <input type="hidden" class="errorMsg" value="{{$errors->first('location')}}">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="commodity">Commodity</label>
                                                <input id="commodity" class="form-control" type="text" name="commodity1" value="{{ old('commodity') }}">
                                                @if($errors->has('commodity'))
                                                    <small class="text-danger">{{ $errors->first('commodity') }}</small>
                                                    <input type="hidden" class="errorMsg" value="{{$errors->first('commodity')}}">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="dimension">Dimension</label>
                                                <input id="dimension" class="form-control" type="text" name="dimension1" value="{{ old('dimension') }}">
                                                @if($errors->has('dimension'))
                                                    <small class="text-danger">{{ $errors->first('dimension') }}</small>
                                                    <input type="hidden" class="errorMsg" value="{{$errors->first('dimension')}}">
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="Date">Date <span class="text-danger">*</span></label>
                                                <input type="text" id="Date" class="form-control" name="dateData1" onblur="(this.type='text')" onfocus="(this.type='date')">
                                                @if($errors->has('pickupDate'))
                                                    <small class="text-danger">{{ $errors->first('pickupDate') }}</small>
                                                    <input type="hidden" class="errorMsg" value="{{$errors->first('pickupDate')}}">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group" align="center">
                                                <label for="load/unload">Load/Unload</label>
                                                <button type='button' class='selectLoadBtn' value='1'>Load</button>
                                            </div>
                                        </div>
                                        <input type="hidden" id="selectLoad1" name="selectLoad1" class="form-control selectLoad" value="Load">
                                    </div>
                                    <div class="row" id="serviceContent">
                                    
                                    </div>
                                    <input type="hidden" id="countData" name="countData" class="form-control" value="1">
                                    
                                    <hr>
                                    <button id="addTableContent" class='selectLoadBtn' type="button"  style="border-radius:5px; background-color:red">Add</button>
                                    <hr>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="weight">Weight</label>
                                            <input id="weight" class="form-control" type="text" name="weight" value="{{ old('weight') }}">
                                            @if($errors->has('weight'))
                                                <small class="text-danger">{{ $errors->first('weight') }}</small>
                                                <input type="hidden" class="errorMsg" value="{{$errors->first('weight')}}">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="temperature">Temperature Condition</label>
                                            <input id="temperature" class="form-control" type="text" name="temperature" value="{{ old('temperature') }}">
                                            @if($errors->has('temperature'))
                                                <small class="text-danger">{{ $errors->first('temperature') }}</small>
                                                <input type="hidden" class="errorMsg" value="{{$errors->first('temperature')}}">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-30">
                                        <div class="form-group">
                                            <label for="equipment">Equipment</label>
                                            <select class="form-control w-100" name="equipment" id="equipment">
                                                @foreach($equipments as $equipment)
                                                <option value="{{$equipment->equipmentId}}">{{$equipment->equipmentName}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-30">
                                        <div class="form-group">
                                            <label for="trailerSize">Trailer Size</label>
                                            <select class="form-control w-100" name="trailerSize" id="trailerSize">
                                                @foreach($trailer_size as $trailer)
                                                <option value="{{$trailer->trailerSizeId}}">{{$trailer->trailerSizeName}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="comment">Freight Description / Shipping Details / Comments</label>
                                            <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="5">{{ old('comment') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="d-flex align-items-center mb-30">
                                            <div class="primary-checkbox">
                                                <input type="checkbox" id="policy-checkbox">
                                                <label class="border border-danger border-2" for="policy-checkbox"></label>
                                            </div>
                                            <label for="policy-checkbox" class="fw-normal ml-3 mb-0">
                                                &nbsp; I agree to Quick Fright Enterprise INC's <a class="text-info" target="_blank" href="{{ route('frontend.privacy') }}#terms">Terms of Use</a>
                                                and <a class="text-info" target="_blank" href="{{ route('frontend.privacy') }}#privacy">Privacy Cookie Policy</a>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <!-- Google reCaptcha v2 -->
                                        {!! htmlFormSnippet() !!}
                                        @if($errors->has('g-recaptcha-response'))
                                        <div>
                                            <small class="text-danger">{{ $errors->first('g-recaptcha-response') }}</small>
                                            <input type="hidden" class="errorMsg" value="{{$errors->first('g-recaptcha-response')}}">
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <div id="request" class="form-group mt-5">
                                    <button id="submitBtn" type="button" class="btn btn-danger">Send</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Order Form End -->
        <!-- Request Service Start -->
        <section id="reqQuote" class="wantToWork-area w-padding section-bg" data-background="{{asset('assets/frontend/img/gallery/section_bg02.jpg')}}">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-7 col-md-8 col-sm-10">
                        <div class="wantToWork-caption">
                            <h2>Do you want to know about your loading status?</h2>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3">
                        <a href="{{route('login.customer')}}" class="btn btn-danger" style="width: 220px">Request Service</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- Request Service End -->
    </main>

    @include('frontendlayouts.footer')

    @include('frontendlayouts.scrollup')

@endsection

@push('scripts')
    <script src="{{asset('assets/frontend/js/pages/services.js')}}"></script>
@endpush

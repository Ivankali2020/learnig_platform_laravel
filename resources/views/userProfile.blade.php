@extends('layouts.app')
@section('style')
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-4">
                <div class="card mb-3 ">
                    <div class="card-body  ">
                        <h3 class="fw-bolder text-center"> My Wallet </h3>

                        <div class="row mt-3  ">
                            <div class="col-4 pr-0 fw-bold text-capitalize "> ID <i class="ml-1 pe-7s-wallet "></i> </div>
                            <div class="col-8 pl-0 text-right fw-bold "> {{ $user->wallet->wallet_unique_id }} </div>
                        </div>
                        <div class="row mt-3  ">
                            <div class="col-4 pr-0 fw-bold text-capitalize "> Amount </div>
                            <div class="col-8 pl-0 text-right fw-bold h6 "> {{ $user->wallet->money }} <span class="fw-bold ">$</span> </div>
                        </div>

                    </div>
                </div>
                <div class="card ">
                    <form action="{{ route('changeProfilePhoto',\Illuminate\Support\Facades\Auth::id()) }}" enctype="multipart/form-data" method="post">
                         @method('put') @csrf
                        <input type="file" hidden accept="image/jpeg,image/png,image/gif,image/jpg" name="photo" id="profile_photo" onchange="this.form.submit()">
                    </form>
                    <img src="{{ asset('storage/profilePhoto/'.$user->Photo) }}" onclick="changeProfilePhoto()" style="cursor: pointer" class=" rounded rounded-circle m-auto " height="150" width="150" alt="">
                    <div class="card-body  ">
                        <h3 class="fw-bolder text-center"> My Profile </h3>
                        <div class="row mt-3  ">
                            <div class="col-4 pr-0 fw-bold text-capitalize "> Name  </div>
                            <div class="col-8 pl-0 text-right "> {{ $user->name }} </div>
                        </div>
                        <div class="row mt-3  ">
                            <div class="col-4 pr-0 fw-bold text-capitalize "> Phone  </div>
                            <div class="col-8 pl-0 text-right "> x09xxxxxxx74 </div>
                        </div>
                        <div class="row mt-3  ">
                            <div class="col-4 pr-0 fw-bold text-capitalize "> Email  </div>
                            <div class="col-8 pl-0 text-right "> {{ $user->email }} </div>
                        </div>
                        <div class="col-12 text-center mt-4  ">
                            <button class="btn btn-light">Edit</button>
                        </div>

                    </div>
                </div>

            </div>
            <div class="col-6  ">
                <div class="card">
                    <div class="card-body">
                        <div class="">
                            <h4 class="fw-bolder mb-4 "> Your Courses </h4>
                            <div class="responsive">
                                @foreach($user->LearningCoursers as $lc)
                                    <div class=" ">
                                        <a href="{{ route('enrollment.custom.show',$lc->course->id) }}" >
                                            <img src="{{ asset('storage/coursePhoto/'.$lc->course->photo) }}" width="150"  alt="">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-4 ">
                    <div class="card-body">
                        <div class="">
                            <h4 class="fw-bolder mb-4 "> Payment History </h4>
                            <table class="table table-responsive-sm">
                                <tr>
                                    <td >#</td>
                                    <td>Amount</td>
                                    <td>Course</td>
                                    <td>Time</td>
                                </tr>
                                <tbody>
                                @foreach($user->LearningCoursers as $key=>$lc)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $lc->payment_money }}</td>
                                        <td>{{ $lc->course->name }}</td>
                                        <td class="text-nowrap ">
                                            <small> <i class="pe-7s-check"></i> {{ $lc->created_at->format('d M Y') }}</small> <br>
                                            <small> <i class="pe-7s-clock"></i> {{ $lc->created_at->format('H:m') }} </small>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>

            </div>
            <div class="col-2 p-0 ">
                <div class="card  ">
                    <div class="card-body">
                        <div class="">
                            <h4 class="fw-bolder mb-4 text-center ">  Certificates </h4>
                            <div class="d-flex flex-column">
                                @foreach($user->certificates as $c)
                                    <a href="{{ route('certificate.request',$c->course_id) }}" class="my-3 text-decoration-none d-flex flex-column ">
                                        <img src="{{ asset('storage/certificates/'.$c->certificate_unique_id.'.png') }}" width="150" alt="">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script>
        function changeProfilePhoto(){
            $('#profile_photo').click();
        }

        $('.responsive').slick({
            centerMode: true,
            centerPadding: '10px',
            slidesToShow: 3,
            arrows: false,
            dots:true,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        arrows: false,
                        centerMode: true,
                        centerPadding: '10px',
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        arrows: false,
                        centerMode: true,
                        centerPadding: '40px',
                        slidesToShow: 1
                    }
                }
                ]
        });
    </script>

@endsection

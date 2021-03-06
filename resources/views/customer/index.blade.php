
@extends('customer.layout')
@section('content')
    <div class="site-blocks-cover" style="background-image: url({{asset('user_assets/images/hero_bg_2.jpg')}});" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-7">
            <span class="sub-text">We Priority Your</span>
            <h1>Your <strong>New Smile</strong></h1>
          </div>
        </div>
      </div>
    </div>

    <div class="site-block-1">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <div class="site-block-feature d-flex p-4 rounded mb-4">
              <div class="mr-3">
                <span class="icon flaticon-tooth font-weight-light text-white h2"></span>
              </div>
              <div class="text">
                <h3>Periontodology</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="site-block-feature d-flex p-4 rounded mb-4">
              <div class="mr-3">
                <span class="icon flaticon-tooth-whitening font-weight-light text-white h2"></span>
              </div>
              <div class="text">
                <h3>Tooth Whitening</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="site-block-feature d-flex p-4 rounded mb-4">
              <div class="mr-3">
                <span class="icon flaticon-tooth-pliers font-weight-light text-white h2"></span>
              </div>
              <div class="text">
                <h3>Preventative Care</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section site-block-3">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 mb-5 mb-lg-0">
            <img src="{{asset('user_assets/images/img_1.jpg')}}" alt="Image" class="img-fluid">
          </div>
          <div class="col-lg-6">
            <div class="row row-items">
              <div class="col-md-6">
                <a href="#" class="d-flex text-center feature active p-4 mb-4">
                  <span class="align-self-center w-100">
                    <span class="d-block mb-3">
                      <span class="flaticon-tooth-whitening display-3"></span>
                    </span>
                    <h3>Tooth Whitening</h3>
                  </span>
                </a>
              </div>
              <div class="col-md-6">
                <a href="#" class="d-flex text-center feature p-4 mb-4">
                  <span class="align-self-center w-100">
                    <span class="d-block mb-3">
                      <span class="flaticon-stethoscope display-3"></span>
                    </span>
                    <h3>Stethoscope</h3>
                  </span>
                </a>
              </div>
            </div>
            <div class="row row-items last">
              <div class="col-md-6">
                <a href="#" class="d-flex text-center feature p-4 mb-4">
                  <span class="align-self-center w-100">
                    <span class="d-block mb-3">
                      <span class="flaticon-first-aid-kit display-3"></span>
                    </span>
                    <h3>First Aid Kit</h3>
                  </span>
                </a>
              </div>
              <div class="col-md-6">
                <a href="#" class="d-flex text-center active feature p-4 mb-4">
                  <span class="align-self-center w-100">
                    <span class="d-block mb-3">
                      <span class="flaticon-tooth-pliers display-3"></span>
                    </span>
                    <h3>Tooth Pliers</h3>
                  </span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="site-section bg-light">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-md-6 text-center">
            <h2 class="site-heading text-black mb-5">Our <strong>Services</strong></h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 col-lg-4">
            <div class="site-block-feature-2 d-flex rounded mb-5">
              <div class="mr-3">
                <span class="icon flaticon-tooth-whitening font-weight-light "></span>
              </div>
              <div class="text">
                <h3>Tooth Whitening</h3>
                <p>Sunt illum fugit doloremque eaque omnis dolor sint fuga eligendi quis magnam Laboriosam facilis.</p>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4">
            <div class="site-block-feature-2 d-flex rounded mb-5">
              <div class="mr-3">
                <span class="icon flaticon-stethoscope font-weight-light "></span>
              </div>
              <div class="text">
                <h3>Stethoscope</h3>
                <p>Sunt illum fugit doloremque eaque omnis dolor sint fuga eligendi quis magnam Laboriosam facilis.</p>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4">
            <div class="site-block-feature-2 d-flex rounded mb-5">
              <div class="mr-3">
                <span class="icon flaticon-dentist-chair font-weight-light "></span>
              </div>
              <div class="text">
                <h3>Dentist Chair</h3>
                <p>Sunt illum fugit doloremque eaque omnis dolor sint fuga eligendi quis magnam Laboriosam facilis.</p>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4">
            <div class="site-block-feature-2 d-flex rounded mb-5">
              <div class="mr-3">
                <span class="icon flaticon-tooth-pliers font-weight-light "></span>
              </div>
              <div class="text">
                <h3>Tooth Pliers</h3>
                <p>Sunt illum fugit doloremque eaque omnis dolor sint fuga eligendi quis magnam Laboriosam facilis.</p>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4">
            <div class="site-block-feature-2 d-flex rounded mb-5">
              <div class="mr-3">
                <span class="icon flaticon-first-aid-kit font-weight-light "></span>
              </div>
              <div class="text">
                <h3>First Aid Kit</h3>
                <p>Sunt illum fugit doloremque eaque omnis dolor sint fuga eligendi quis magnam Laboriosam facilis.</p>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4">
            <div class="site-block-feature-2 d-flex rounded mb-5">
              <div class="mr-3">
                <span class="icon flaticon-dentist-tools font-weight-light "></span>
              </div>
              <div class="text">
                <h3>Dentist Tools</h3>
                <p>Sunt illum fugit doloremque eaque omnis dolor sint fuga eligendi quis magnam Laboriosam facilis.</p>
              </div>
            </div>
          </div>



        </div>
      </div>
    </div>

    <div class="site-block-half d-block d-lg-flex site-block-video">
      <div class="image bg-image order-2" style="background-image: url({{asset('user_assets/images/hero_bg_1.jpg')}}); ">
        <a href="https://vimeo.com/channels/staffpicks/93951774" class="play-button popup-vimeo"><span class="icon-play"></span></a>
      </div>
      <div class="text order-1">
        <h2 class="site-heading text-black mb-3">Success <strong>Stories</strong></h2>
        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id cum vel, eius nulla inventore aperiam excepturi molestias incidunt, culpa alias repudiandae, a nobis libero vitae repellendus temporibus vero sit natus.</p>
        <p>Dolores perferendis ipsam animi fuga, dolor pariatur aliquam esse. Modi maiores minus velit iste enim sunt iusto, dolore totam consequuntur incidunt illo voluptates vero quaerat excepturi. Iusto dolor, cum et.</p>
      </div>

    </div>


    <div class="site-section bg-light">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-md-6 text-center">
            <h2 class="site-heading text-black">People <strong>Says</strong></h2>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4">
            <div class="site-block-testimony p-4 text-center">
              <div class="mb-3">
                <img src="{{asset('user_assets/images/person_2.jpg')}}" alt="Image" class="img-fluid">
              </div>
              <div>
                 <p>Dolores perferendis ipsam animi fuga, dolor pariatur aliquam esse. Modi maiores minus velit iste enim sunt iusto dolore</p>
                 <p><strong class="font-weight-bold">Nathalie Oscar</strong></p>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="site-block-testimony p-4 text-center active">
              <div class="mb-3">
                <img src="{{asset('user_assets/images/person_1.jpg')}}" alt="Image" class="img-fluid">
              </div>
              <div>
                 <p>Dolores perferendis ipsam animi fuga dolor pariatur aliquam esse. Modi maiores minus velit iste enim sunt iusto dolore</p>
                 <p><strong class="font-weight-bold">Linda Uler</strong></p>
              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="site-block-testimony p-4 text-center">
              <div class="mb-3">
                <img src="{{asset('user_assets/images/person_3.jpg')}}" alt="Image" class="img-fluid">
              </div>
              <div>
                 <p>Dolores perferendis ipsam animi fuga dolor pariatur aliquam esse. Modi maiores minus velit iste enim sunt iusto dolore</p>
                 <p><strong class="font-weight-bold">Chris Coodard</strong></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection







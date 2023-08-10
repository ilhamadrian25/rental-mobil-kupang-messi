@extends('frontend/layout/app')

@section('content')
    <section class="hero-wrap hero-wrap-2 js-fullheight"
        style="background-image: url('{{ asset('assets/images/bg_3.jpg') }}');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
                <div class="col-md-9 ftco-animate pb-5">
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Beranda <i
                                    class="ion-ios-arrow-forward"></i></a></span> <span class="mr-2"><a
                                href="{{ route('article') }}">Artikel <i class="ion-ios-arrow-forward"></i></a></span>
                        <span>Blog Single
                            <i class="ion-ios-arrow-forward"></i></span>
                    </p>
                    <h1 class="mb-3 bread">Read our blog</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-degree-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-8 ftco-animate">
                    <h2 class="mb-3">It is a long established fact a reader be distracted</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis, eius mollitia suscipit,
                        quisquam doloremque distinctio perferendis et doloribus unde architecto optio laboriosam porro
                        adipisci sapiente officiis nemo accusamus ad praesentium? Esse minima nisi et. Dolore perferendis,
                        enim praesentium omnis, iste doloremque quia officia optio deserunt molestiae voluptates soluta
                        architecto tempora.</p>
                    <p>
                        <img src="images/image_7.jpg" alt="" class="img-fluid">
                    </p>
                    <p>Molestiae cupiditate inventore animi, maxime sapiente optio, illo est nemo veritatis repellat sunt
                        doloribus nesciunt! Minima laborum magni reiciendis qui voluptate quisquam voluptatem soluta illo
                        eum ullam incidunt rem assumenda eveniet eaque sequi deleniti tenetur dolore amet fugit perspiciatis
                        ipsa, odit. Nesciunt dolor minima esse vero ut ea, repudiandae suscipit!</p>
                    <h2 class="mb-3 mt-5">#2. Creative WordPress Themes</h2>
                    <p>Temporibus ad error suscipit exercitationem hic molestiae totam obcaecati rerum, eius aut, in.
                        Exercitationem atque quidem tempora maiores ex architecto voluptatum aut officia doloremque. Error
                        dolore voluptas, omnis molestias odio dignissimos culpa ex earum nisi consequatur quos odit quasi
                        repellat qui officiis reiciendis incidunt hic non? Debitis commodi aut, adipisci.</p>
                    <p>
                        <img src="images/image_8.jpg" alt="" class="img-fluid">
                    </p>
                    <p>Quisquam esse aliquam fuga distinctio, quidem delectus veritatis reiciendis. Nihil explicabo quod,
                        est eos ipsum. Unde aut non tenetur tempore, nisi culpa voluptate maiores officiis quis vel ab
                        consectetur suscipit veritatis nulla quos quia aspernatur perferendis, libero sint. Error, velit,
                        porro. Deserunt minus, quibusdam iste enim veniam, modi rem maiores.</p>
                    <p>Odit voluptatibus, eveniet vel nihil cum ullam dolores laborum, quo velit commodi rerum eum quidem
                        pariatur! Quia fuga iste tenetur, ipsa vel nisi in dolorum consequatur, veritatis porro explicabo
                        soluta commodi libero voluptatem similique id quidem? Blanditiis voluptates aperiam non magni.
                        Reprehenderit nobis odit inventore, quia laboriosam harum excepturi ea.</p>
                    <p>Adipisci vero culpa, eius nobis soluta. Dolore, maxime ullam ipsam quidem, dolor distinctio similique
                        asperiores voluptas enim, exercitationem ratione aut adipisci modi quod quibusdam iusto, voluptates
                        beatae iure nemo itaque laborum. Consequuntur et pariatur totam fuga eligendi vero dolorum
                        provident. Voluptatibus, veritatis. Beatae numquam nam ab voluptatibus culpa, tenetur recusandae!
                    </p>
                    <p>Voluptas dolores dignissimos dolorum temporibus, autem aliquam ducimus at officia adipisci quasi nemo
                        a perspiciatis provident magni laboriosam repudiandae iure iusto commodi debitis est blanditiis
                        alias laborum sint dolore. Dolores, iure, reprehenderit. Error provident, pariatur cupiditate soluta
                        doloremque aut ratione. Harum voluptates mollitia illo minus praesentium, rerum ipsa debitis,
                        inventore?</p>
                </div> <!-- .col-md-8 -->
                <div class="col-md-4 sidebar ftco-animate">
                    <div class="sidebar-box">
                        <form action="#" class="search-form">
                            <div class="form-group">
                                <span class="icon icon-search"></span>
                                <input type="text" class="form-control" placeholder="Type a keyword and hit enter">
                            </div>
                        </form>
                    </div>
                    <div class="sidebar-box ftco-animate">
                        <div class="categories">
                            <h3>Kategori</h3>
                            @foreach ($category as $item)
                                <li><a href="#">{{ $item->name }} <span>({{ $item->article_count }})</span></a>
                                </li>
                            @endforeach
                        </div>
                    </div>

                    <div class="sidebar-box ftco-animate">
                        <h3>Recent Blog</h3>
                        <div class="block-21 mb-4 d-flex">
                            <a class="blog-img mr-4" style="background-image: url(images/image_1.jpg);"></a>
                            <div class="text">
                                <h3 class="heading"><a href="#">Why Lead Generation is Key for Business Growth</a>
                                </h3>
                                <div class="meta">
                                    <div><a href="#"><span class="icon-calendar"></span>Oct. 29, 2019</a></div>
                                    <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                                    <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="block-21 mb-4 d-flex">
                            <a class="blog-img mr-4" style="background-image: url(images/image_2.jpg);"></a>
                            <div class="text">
                                <h3 class="heading"><a href="#">Why Lead Generation is Key for Business Growth</a>
                                </h3>
                                <div class="meta">
                                    <div><a href="#"><span class="icon-calendar"></span>Oct. 29, 2019</a></div>
                                    <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                                    <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="block-21 mb-4 d-flex">
                            <a class="blog-img mr-4" style="background-image: url(images/image_3.jpg);"></a>
                            <div class="text">
                                <h3 class="heading"><a href="#">Why Lead Generation is Key for Business Growth</a>
                                </h3>
                                <div class="meta">
                                    <div><a href="#"><span class="icon-calendar"></span>Oct. 29, 2019</a></div>
                                    <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                                    <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section> <!-- .section -->
@endsection

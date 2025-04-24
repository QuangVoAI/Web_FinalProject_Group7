<?php
include_once __DIR__ . '/layout/header.php';
include_once __DIR__ . '/layout/header_content.php';
?>

<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>

<!-- Hero Section Begin -->
<section class="hero hero-normal">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>All departments</span>
                    </div>
                    <ul>
                        <!-- Category Group: Lifestyle -->
                        <li><a href="#">Fashion</a></li>
                        <li><a href="#">Footwear</a></li>
                        <li><a href="#">Jewelry & Accessories</a></li>
                        <li><a href="#">Beauty & Personal Care</a></li>

                        <!-- Category Group: Family & Home -->
                        <li><a href="#">Home & Kitchen</a></li>
                        <li><a href="#">Baby & Kids</a></li>
                        <li><a href="#">Pet Supplies</a></li>

                        <!-- Category Group: Essentials -->
                        <li><a href="#">Groceries</a></li>
                        <li><a href="#">Health & Wellness</a></li>
                        <li><a href="#">Books & Stationery</a></li>

                        <!-- Category Group: Tech & Entertainment -->
                        <li><a href="#">Electronics</a></li>
                        <li><a href="#">Toys & Games</a></li>
                        <li><a href="#">Sports & Outdoors</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="#">
                            <div class="hero__search__categories">
                                All Categories
                                <span class="arrow_carrot-down"></span>
                            </div>
                            <input type="text" placeholder="What do you need?">
                            <button type="submit" class="site-btn">SEARCH</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>028 2008 1888</h5>
                            <span>Support 24/7 time</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Contact Us</h2>
                    <div class="breadcrumb__option">
                        <a href="/?page=index">Home</a>
                        <span>Contact Us</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Contact Section Begin -->
<section class="contact spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_phone"></span>
                    <h4>Phone</h4>
                    <p>(+84) 028 2008 1888</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_pin_alt"></span>
                    <h4>Address</h4>
                    <p>District 7, Ho Chi Minh City</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_clock_alt"></span>
                    <h4>Open time</h4>
                    <p>7:00 am to 17:30 pm</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_mail_alt"></span>
                    <h4>Email</h4>
                    <p>iamBeezy@gmail.com</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact Section End -->

<!-- Map Begin -->
<div class="map">
    <iframe 
        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d23560.83662302175!2d106.6839203!3d10.7344406!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317528b2747a81a3%3A0x33c1813055acb613!2zxJDhuqFpIGjhu41jIFTDtG4gxJDhu6ljIFRo4bqvbmc!5e1!3m2!1svi!2s!4v1744299409538!5m2!1svi!2s" 
        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

    <div class="map-inside">
        <i class="icon_pin"></i>
        <div class="inside-widget">
            <h4>TDTU</h4>
            <ul>
                <li>Phone: (+84) 028 2008 1888</li>
                <li>Add: 19 Nguyễn Hữu Thọ, Tân Phong, Quận 7, Hồ Chí Minh</li>
            </ul>
        </div>
    </div>
</div>
<!-- Map End -->

<!-- Contact Form Begin -->
<div class="contact-form spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="contact__form__title">
                    <h2>Leave Message</h2>
                </div>
            </div>
        </div>
        <form action="#">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <input type="text" placeholder="Your name">
                </div>
                <div class="col-lg-6 col-md-6">
                    <input type="text" placeholder="Your Email">
                </div>
                <div class="col-lg-12 text-center">
                    <textarea placeholder="Your message"></textarea>
                    <button type="submit" class="site-btn">SEND MESSAGE</button>
  </div>
            </div>
        </form>
    </div>
</div>
<!-- Contact Form End -->

<?php include_once __DIR__ . '/layout/footer.php'; ?>
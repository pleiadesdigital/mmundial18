import $ from 'jquery';

class HeroSlider {
  constructor() {
    this.els = $(".hero-slider");
    this.initSlider();
  }

  initSlider() {
    this.els.slick({
      autoplay: true,
      autoplaySpeed: 8000,
      speed: 800,
      fade: true,
      arrows: false,
      dots: true,
    });
  }
}

export default HeroSlider;

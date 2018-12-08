import $ from 'jquery';

class Search {
  // 1. Describe and create/initiate the object
  constructor() {
    this.addSearchHTML();
    this.resultsDiv = $("#search-overlay__results");
    this.openButton = $(".js-search-trigger");
    this.closeButton = $(".search-overlay__close");
    this.searchOverlay = $(".search-overlay");
    this.searchField = $('#search-term');
    // make browser aware of the object
    this.events();
    this.isOverlayOpen = false;
    this.isSpinnerVisible = false;
    this.previousValue;
    this.typingTimer;
  }

  // 2. Events
  events() {
    this.openButton.on("click", this.openOverlay.bind(this));
    this.closeButton.on("click", this.closeOverlay.bind(this));
    $(document).on("keydown", this.keyPressDispatcher.bind(this));
    this.searchField.on("keyup", this.typingLogic.bind(this));
  }

  // 3. Methods (function, action...)

  typingLogic() {

    if (this.searchField.val() != this.previousValue) {
      clearTimeout(this.typingTimer);
      if (this.searchField.val()) {
        if (!this.isSpinnerVisible) {
          this.resultsDiv.html('<div class="spinner-loader"></div>');
          this.isSpinnerVisible = true;
        }
        this.typingTimer = setTimeout(this.getResults.bind(this), 750);
      } else {
        this.resultsDiv.html('');
        this.isSpinnerVisible = false;
      }
    }

    this.previousValue = this.searchField.val();

  }

  getResults() {

    //var searchURL = universityData.root_url + '/wp-json/university/v1/search?term=' + this.searchField.val();
    $.getJSON(universityData.root_url + '/wp-json/university/v1/search?term=' + this.searchField.val(), (results) => {
      this.resultsDiv.html(`
        <div class="row">

          <div class="one-third">
            <h2 class="search-overlay__section-title">General Information</h2>
            ${results.generalInfo.length ? '<ul class="link-list min-list">' : '<p>No general information matches that search.</p>'}
              ${results.generalInfo.map(item => `<li><a href="${item.permalink}">${item.title}</a> ${item.postType == 'post' ? `by ${item.authorName}` : ''}</li>`).join('')}
            ${results.generalInfo.length ? '</ul>' : ''}
          </div>

          <div class="one-third">
            <h2 class="search-overlay__section-title">Professors</h2>
            ${results.professors.length ? '<ul class="professor-cards">' : '<p>No professor(s) matches that search.</p>'}
              ${results.professors.map(item => `
                <li class="professor-card__list-item">
                  <a class="professor-card" href="${item.permalink}">
                    <img class="professor-card__image" src="${item.photoSmall}">
                    <span class="professor-card__name">${item.title}</span>
                  </a>
                </li>
              `).join('')}
            ${results.professors.length ? '</ul>' : ''}
            <h2 class="search-overlay__section-title">Programs</h2>
            ${results.programs.length ? '<ul class="link-list min-list">' : `<p>No program(s) match that search. <a href="${universityData.root_url}/programs">View all programs</a></p>`}
              ${results.programs.map(item => `<li><a href="${item.permalink}">${item.title}</a></li>`).join('')}
            ${results.programs.length ? '</ul>' : ''}
          </div>

          <div class="one-third">
            <h2 class="search-overlay__section-title">Campuses</h2>
            ${results.campuses.length ? '<ul class="link-list min-list">' : `<p>No campus(es) match that search. <a href="${universityData.root_url}/campuses">View all campuses.</a></p>`}
              ${results.campuses.map(item => `<li><a href="${item.permalink}">${item.title}</a></li>`).join('')}
            ${results.campuses.length ? '</ul>' : ''}


            <h2 class="search-overlay__section-title">Events</h2>
            ${results.events.length ? '' : `<p>No event(s) matches that search. <a href="${universityData.root_url}/events">View all events</a></p>`}
              ${results.events.map(item => `
                <div class="event-summary">
                  <a class="event-summary__date t-center" href="${item.permalink}">
                    <span class="event-summary__month">${item.eventMonth}</span>
                    <span class="event-summary__day">${item.eventDay}</span>
                  </a>
                  <div class="event-summary__content">
                    <h5 class="event-summary__title headline headline--tiny"><a href="${item.permalink}">${item.title}</a></h5>
                    <p>${item.eventExcerpt}<br><a href="${item.permalink}" class="nu gray">Read more</a></p>
                  </div>
                </div>
                `).join('')}
            ${results.events.length ? '</div>' : ''}
          </div>
        </div>
      `);
      this.isSpinnerVisible = false;
    });
    //if (has_excerpt()) { echo get_the_excerpt(); } else  { echo wp_trim_words(get_the_content(), 18); }
  }

  openOverlay() {
    this.searchOverlay.addClass("search-overlay--active");
    $("body").addClass("body-no-scroll");
    this.searchField.val('');
    setTimeout(() => this.searchField.focus(), 301);
    //console.log('our OPEN method just ran!');
    this.isOverlayOpen = true;
    return false;
  }

  closeOverlay() {
    this.searchOverlay.removeClass("search-overlay--active");
    $("body").removeClass("body-no-scroll");
    //console.log('our CLOSE method just ran!');
    this.isOverlayOpen = false;
  }

  keyPressDispatcher(e) {
    e.keyCode;
    // check the key number
    //console.log(e.keyCode);

    if (e.keyCode == 83 && !this.isOverlayOpen && !$("input, textarea").is(':focus')) {
      this.openOverlay();
    }
    if (e.keyCode == 27 && this.isOverlayOpen) {
      this.closeOverlay();
    }
  }

  addSearchHTML() {
    $('#search-container').append(`
      <div class="search-overlay">
        <div class="search-overlay__top">
          <div class="container">
            <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
            <input type="text" class="search-term" id="search-term" placeholder="What are you looking for?" name="Search">
            <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
          </div><!-- class="container" -->
        </div><!-- class="search-overlay__top" -->
        <div class="container">
          <div id="search-overlay__results">

          </div><!-- id="search-overlay__results" -->
        </div><!-- class="container" -->
      </div><!-- class="search-overlay" -->
    `);
  }  /*addSearchHTML()*/

} /*class Search*/

export default Search;






















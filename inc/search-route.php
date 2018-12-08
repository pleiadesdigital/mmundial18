<?php

function universityRegisterSearch () {
  register_rest_route('university/v1', 'search', array(
    'methods'     => WP_REST_SERVER::READABLE,
    'callback'    => 'universitySearchResults'
  ));
}

function universitySearchResults($data) {
  $args = array(
    'post_type'     => array('post', 'page', 'professor', 'program', 'campus', 'event'),
    's'             => sanitize_text_field($data['term'])
  );
  $mainQuery = new WP_Query($args);

  $results = array(
    'generalInfo'       => array(),
    'professors'        => array(),
    'programs'          => array(),
    'events'            => array(),
    'campuses'          => array()
  );

  while ($mainQuery->have_posts()) {
    $mainQuery->the_post();

    if (get_post_type() == 'post' || get_post_type() == 'page') {
      array_push($results['generalInfo'], array(
        'title'         => get_the_title(),
        'permalink'     => get_the_permalink(),
        'description'   => get_the_content(),
        'postType'      => get_post_type(),
        'authorName'    => get_the_author()
      ));
    }

    if (get_post_type() == 'professor') {
      array_push($results['professors'], array(
        'title'         => get_the_title(),
        'permalink'     => get_the_permalink(),
        'description'   => get_the_content(),
        'photoSmall'    => get_the_post_thumbnail_url(0, 'professor-landscape')
      ));
    }

    if (get_post_type() == 'program') {
      $relatedCampuses = get_field('related_campus');
      if ($relatedCampuses) {
        foreach ($relatedCampuses as $campus) {
          array_push($results['campuses'], array(
            'title'     => get_the_title($campus),
            'permalink' => get_the_permalink($campus)
          ));
        }
      }


      array_push($results['programs'], array(
        'title'         => get_the_title(),
        'id'            => get_the_ID(),
        'permalink'     => get_the_permalink(),
        'description'   => get_the_content()
      ));
    }

    if (get_post_type() == 'event') {
      $eventDate = new DateTime(get_field('event_date'));
      $eventExcerpt = null;
      if (has_excerpt()) { $eventExcerpt = get_the_excerpt(); } else  { $eventExcerpt = wp_trim_words(get_the_content(), 18); }
      array_push($results['events'], array(
        'title'         => get_the_title(),
        'permalink'     => get_the_permalink(),
        'description'   => get_the_content(),
        'eventDay'      => $eventDate->format('M'),
        'eventMonth'    => $eventDate->format('d'),
        'eventExcerpt'  => $eventExcerpt
      ));
    }

    if (get_post_type() == 'campus') {
      array_push($results['campuses'], array(
        'title'       => get_the_title(),
        'permalink'   => get_the_permalink(),
        'description' => get_the_content()
      ));
    }
  } /*while ($mainQuery->have_posts())*/

  if ($results['programs']) {
    $programsMetaQuery = array('relation' => 'OR');

    foreach ($results['programs'] as $item) {
      array_push($programsMetaQuery, array(
        'key'         => 'related_programs',
        'compare'     => 'LIKE',
        'value'       => '"' . $item['id'] . '"'
      ));
    }

    $args = array(
      'post_type'       => array('professor', 'event'),
      'meta_query'      => $programsMetaQuery
    );
    $programRelationshipQuery = new WP_Query($args);

    while ($programRelationshipQuery->have_posts()) {
      $programRelationshipQuery->the_post();

      if (get_post_type() == 'event') {
        $eventDate = new DateTime(get_field('event_date'));
        $eventExcerpt = null;
        if (has_excerpt()) { $eventExcerpt = get_the_excerpt(); } else  { $eventExcerpt = wp_trim_words(get_the_content(), 18); }
        array_push($results['events'], array(
          'title'         => get_the_title(),
          'permalink'     => get_the_permalink(),
          'description'   => get_the_content(),
          'eventDay'      => $eventDate->format('M'),
          'eventMonth'    => $eventDate->format('d'),
          'eventExcerpt'  => $eventExcerpt
        ));
      }

      if (get_post_type() == 'professor') {
        array_push($results['professors'], array(
          'title'         => get_the_title(),
          'permalink'     => get_the_permalink(),
          'description'   => get_the_content(),
          'photoSmall'    => get_the_post_thumbnail_url(0, 'professor-landscape')
        ));
      }

    }

    $results['professors'] = array_values(array_unique($results['professors'], SORT_REGULAR));

    $results['events'] = array_values(array_unique($results['events'], SORT_REGULAR));
  }

  return $results;
}

add_action('rest_api_init', 'universityRegisterSearch');

























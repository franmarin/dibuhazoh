# Dibuhazoh

_ajax-infinite-scroll + dynamic multi-column layout + old cartoons_

This project is a simple page designed to have infinite scroll and use lazy 
load, adjusting content dynamically to display information about old cartoons 
from 90s, 80s, 70s and below.

See it working [from this link](http://s390460192.mialojamiento.es/dibuhazoh).

## Motivation

### Technical

Finding a technique to display web content with images over a multi-colum 
layout, placing them in optimal position based on available vertical space, plus
loading such content dynamically while scrolling down, leaded me to design and 
implement this page.

From scratch, with the bare minimum code needed and as few thir-party components
as possible to have a light stand-alone architecture, I decided to use pure 
HTML5, CSS3, PHP and JavaScript.

Having our own infinite-scroll and lazy-load implementation, these have been the
only external dependencies:
* [jQuery](https://jquery.com/)
* [Masonry](http://masonry.desandro.com/)
* [imagesLoaded](http://imagesloaded.desandro.com/)

### Nostalgic

Recalling old cartoon series, movie collections, quiz and shows for kids that
were broadcast in Spain from 90s, 80s, 70s and below.

Seeing quality of today's TV in terms of language, arguments and content in 
general, we need to recover those old cartoon series, movies, shows and quizzes 
that could make time our kids spend in front of the television, more enjoyable, 
didactic and even fruitful.

That's when I started to add more elements to my original series list and 
realized that this would be more useful if it was displayed from a site (in 
Spanish) that could make such volume of information easy to handle.

## Dibuhazoh?

The term represents all variety of TV content shown from this page.

"Dibuhazoh" is plural of "dibuhazo", which means series, movies collection, quiz
or show for kids.

It's a word inspired in one of the Andalusian phonetic representations of 
"dibujazos", that is the augmentative of "dibujos", the Spanish word that 
means "cartoons".

## TO-DO

* Add missing data.
* Move data from CSV file to relational database.
* Optimise and polish CSS, mainly for IE.

* * *
Copyright (c) 2017 Fran Marín
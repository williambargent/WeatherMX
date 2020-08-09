/*!
 * Suggest jQuery plugin
 *
 * Copyright (c) 2015 Florian Plank (http://www.polarblau.com/)
 * Dual licensed under the MIT (https://opensource.org/licenses/MIT)
 * and GPL (https://opensource.org/licenses/GPL-2.0) licenses.
 * 
 * * * Modified for WeatherMX * * *
 * - Removes options and attributes
 * - Adds classes to <div>'s
 * - Removes 'more' <span> and related code
 * - Removes css and related code
 * - Minified
 *
 */

(function($) {

  $.fn.suggest = function(source) {

    return this.each(function() {

      $this = $(this);

      // this helper will show possible suggestions
      // and needs to match the input field in style
      var $suggest = $('<div/>', {
        'class' : 'autocomplete-text'
      });

      $this .wrap($('<div/>', {
          'class': 'autocomplete'
        }))

        .bind('keydown.suggest', function(e){
          var code = (e.keyCode ? e.keyCode : e.which);

          // the tab key will force the focus to the next input
          // already on keydown, let's prevent that
          // unless the alt key is pressed for convenience
          if (code == 9 && !e.altKey) {
            e.preventDefault();

          // let's prevent default enter behavior while a suggestion
          // is being accepted (e.g. while submitting a form)
          } else if (code == 13) {
            if (!$suggest.is(':empty')) {
              e.preventDefault();
            }

          // use arrow keys to cycle through suggestions
          } else if (code == 38 || code == 40) {
            e.preventDefault();
            var suggestions = $(this).data('suggestions');

            if (suggestions.all.length > 1) {
              // arrow down:
              if (code == 40 && suggestions.index < suggestions.all.length - 1) {
                suggestions.suggest.html(suggestions.all[++suggestions.index]);
              // arrow up:
              } else if (code == 38 && suggestions.index > 0) {
                suggestions.suggest.html(suggestions.all[--suggestions.index]);
              }
              $(this).data('suggestions').index = suggestions.index;
            }
          }
        })

        .bind('keyup.suggest', function(e) {
          var code = (e.keyCode ? e.keyCode : e.which);

          // Have the arrow keys been pressed?
          if (code == 38 || code == 40) {
            return false;
          }


          // what has been input?
          var needle = $(this).val();

          // convert spaces to make them visible
          var needleWithWhiteSpace = needle.replace(' ', '&nbsp;');

          // accept suggestion with 'enter' or 'tab'
          // if the suggestion hasn't been accepted yet
          if (code == 9 || code == 13) {
            // only accept if there's anything suggested
            if ($suggest.text().length > 0) {
              e.preventDefault();
              var suggestions = $(this).data('suggestions');
              $(this).val(suggestions.terms[suggestions.index]);
              // clean the suggestion for the looks
              $suggest.empty();
              return false;
            }
          }

          // make sure the helper is empty
          $suggest.empty();

          // if nothing has been input, leave it with that
          if (!$.trim(needle).length) {
            return false;
          }

          // see if anything in source matches the input
          // by escaping the input' string for use with regex
          // we allow to search for terms containing specials chars as well
          var regex = new RegExp('^' + needle.replace(/[-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&"), 'i');
          var suggestions = [], terms = [];
          for (var i = 0, l = source; i < l.length; i++) {
            if (regex.test(l[i])) {
              terms.push(l[i]);
              suggestions.push(needleWithWhiteSpace + l[i].slice(needle.length));
            }
          }
          if (suggestions.length > 0) {
            // if there's any suggestions found, use the first
            // don't show the suggestion if it's identical with the current input
            if (suggestions[0] !== needle) {
              $suggest.html(suggestions[0]);
            }
            // store found suggestions in data for use with arrow keys
            $(this).data('suggestions', {
              'all'    : suggestions,
              'terms'  : terms,
              'index'  : 0,
              'suggest': $suggest
            });

          }
        })

        // clear suggestion on blur
        .bind('blur.suggest', function(){
          $suggest.empty();
        });

        // insert the suggestion helpers within the wrapper
        $suggest.insertAfter($this);

    });

  };
})(jQuery);

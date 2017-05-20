   
  function inCommentOrString(index, line) {
    var character;
    while (--index > -1) {
      character = line.substr(index, 1);
      if (character === '"' || character === '\'' || character === '.') {
        // our loop keyword was actually either in a string or a property, so let's exit and ignore this line
        DEBUG && debug('- exit: matched inside a string or property key'); // jshint ignore:line
        return true;
      }
      if (character === '/' || character === '*') {
        // looks like a comment, go back one to confirm or not
        var prevCharacter = line.substr(index - 1, 1);
        if (prevCharacter === '/') {
          // we've found a comment, so let's exit and ignore this line
          DEBUG && debug('- exit: part of a comment'); // jshint ignore:line
          return true;
        }
      }
    }
    return false;
  }

 function transitionStacked() {
      xScale.domain = ([0, xStackMax]);
      rect.transition()
        .duration(500)
        .delay(function (d, i) {
          return i * 10;
        })
        .attr("x", function (d) {
          return xScale(d.x0);
        })
        .transition()
        .attr("y", function (d) {
          return y0Scale(d.label);
        })
        .attr("height", y0Scale.rangeBand())
    }

function change() {
      if ($("body").data("state") === "stacked") {
        transitionGrouped();
        $("body").data("state", "grouped");
      } else {
        transitionStacked();
        $("body").data("state", "stacked");
      }
    }


    function transitionGrouped() {
      xScale.domain = ([0, xGroupMax]);
      rect.transition()
        .duration(500)
        .delay(function (d, i) {
          return i * 10;
        })
        .attr("width", function (d) {
          return xScale((d.x1) - (d.x0));
        })
        .transition()
        .attr("y", function (d) {
          return y1Scale(d.label);
        })
        .attr("x", 0)
        .attr("height", y1Scale.rangeBand())
    }



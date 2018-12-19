<?php ?>
.hide-on-desktop{
	display:none;
}
@media(max-width:1024px){
	.hide-on-desktop{
		display:block
	}
}

.screen-reader-text, .screen-reader-text span {
	position: absolute;
    top: -10000em;
    width: 1px; 
    height: 1px;
    margin: -1px;
    padding: 0;
    overflow: hidden;
    clip: rect(0,0,0,0);
    border: 0;
}


/*************************
Header Options css
*************************/
.customify-container{
    padding: 0px 25px;
    width: 100%;
    display: inline-block;
    color: #fff;
}



[class~="customify-grid"],
[class*="customify-grid-"],
[class*="customify-grid_"] {
  box-sizing: border-box;
  display: -webkit-box;
  display: -ms-flexbox;
  /*display: flex;*/
  -webkit-box-orient: horizontal;
  -webkit-box-direction: normal;
      -ms-flex-flow: row wrap;
          flex-flow: row wrap;
  margin: 0 -1em;
}

[class~="customify-col"],
[class*="customify-col-"],
[class*="customify-col_"] {
  box-sizing: border-box;
  padding: 0 1em 0;
  max-width: 100%;
}

[class~="customify-col"],
[class*="customify-col_"] {
  -webkit-box-flex: 1;
      -ms-flex: 1 1 0%;
          flex: 1 1 0%;
}

[class*="customify-col-"] {
  -webkit-box-flex: 0;
      -ms-flex: none;
          flex: none;
}

[class~="customify-grid"][class~="customify-col"],
[class~="customify-grid"][class*="customify-col-"],
[class~="customify-grid"][class*="customify-col_"],
[class*="customify-grid-"][class~="customify-col"],
[class*="customify-grid-"][class*="customify-col-"],
[class*="customify-grid-"][class*="customify-col_"],
[class*="customify-grid_"][class~="customify-col"],
[class*="customify-grid_"][class*="customify-col-"],
[class*="customify-grid_"][class*="customify-col_"] {
  margin: 0;
  padding: 0;
}

/************************
    HELPERS SUFFIXES
*************************/
[class*="customify-grid-"][class*="-noGutter"] {
  margin: 0;
}
[class*="customify-grid-"][class*="-noGutter"] > [class~="customify-col"],
[class*="customify-grid-"][class*="-noGutter"] > [class*="customify-col-"] {
  padding: 0;
}
[class*="customify-grid-"][class*="-noWrap"] {
  -ms-flex-wrap: nowrap;
      flex-wrap: nowrap;
}
[class*="customify-grid-"][class*="-center"] {
  -webkit-box-pack: center;
      -ms-flex-pack: center;
          justify-content: center;
}
[class*="customify-grid-"][class*="-right"] {
  -webkit-box-pack: end;
      -ms-flex-pack: end;
          justify-content: flex-end;
  -ms-flex-item-align: end;
      align-self: flex-end;
  margin-left: auto;
}
[class*="customify-grid-"][class*="-top"] {
  -webkit-box-align: start;
      -ms-flex-align: start;
          align-items: flex-start;
}
[class*="customify-grid-"][class*="-middle"] {
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
}
[class*="customify-grid-"][class*="-bottom"] {
  -webkit-box-align: end;
      -ms-flex-align: end;
          align-items: flex-end;
}
[class*="customify-grid-"][class*="-reverse"] {
  -webkit-box-orient: horizontal;
  -webkit-box-direction: reverse;
      -ms-flex-direction: row-reverse;
          flex-direction: row-reverse;
}
[class*="customify-grid-"][class*="-column"] {
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
      -ms-flex-direction: column;
          flex-direction: column;
}
[class*="customify-grid-"][class*="-column"] > [class*="customify-col-"] {
  -ms-flex-preferred-size: auto;
      flex-basis: auto;
}
[class*="customify-grid-"][class*="-column-reverse"] {
  -webkit-box-orient: vertical;
  -webkit-box-direction: reverse;
      -ms-flex-direction: column-reverse;
          flex-direction: column-reverse;
}
[class*="customify-grid-"][class*="-spaceBetween"] {
  -webkit-box-pack: justify;
      -ms-flex-pack: justify;
          justify-content: space-between;
}
[class*="customify-grid-"][class*="-spaceAround"] {
  -ms-flex-pack: distribute;
      justify-content: space-around;
}
[class*="customify-grid-"][class*="-equalHeight"] > [class~="customify-col"], [class*="customify-grid-"][class*="-equalHeight"] > [class*="customify-col-"], [class*="customify-grid-"][class*="-equalHeight"] > [class*="customify-col_"] {
  -ms-flex-item-align: stretch;
      align-self: stretch;
}
[class*="customify-grid-"][class*="-equalHeight"] > [class~="customify-col"] > *, [class*="customify-grid-"][class*="-equalHeight"] > [class*="customify-col-"] > *, [class*="customify-grid-"][class*="-equalHeight"] > [class*="customify-col_"] > * {
  height: 100%;
}
[class*="customify-grid-"][class*="-noBottom"] > [class~="customify-col"], [class*="customify-grid-"][class*="-noBottom"] > [class*="customify-col-"], [class*="customify-grid-"][class*="-noBottom"] > [class*="customify-col_"] {
  padding-bottom: 0;
}

[class*="customify-col-"][class*="-top"] {
  -ms-flex-item-align: start;
      align-self: flex-start;
}
[class*="customify-col-"][class*="-middle"] {
  -ms-flex-item-align: center;
      align-self: center;
}
[class*="customify-col-"][class*="-bottom"] {
  -ms-flex-item-align: end;
      align-self: flex-end;
}
[class*="customify-col-"][class*="-first"] {
  -webkit-box-ordinal-group: 0;
      -ms-flex-order: -1;
          order: -1;
}
[class*="customify-col-"][class*="-last"] {
  -webkit-box-ordinal-group: 2;
      -ms-flex-order: 1;
          order: 1;
}

/************************
    GRID BY NUMBER
*************************/
[class*="customify-grid-1"] > [class~="customify-col"],
[class*="customify-grid-1"] > [class*="customify-col-"],
[class*="customify-grid-1"] > [class*="customify-col_"] {
  -ms-flex-preferred-size: 100%;
      flex-basis: 100%;
  max-width: 100%;
}

[class*="customify-grid-2"] > [class~="customify-col"],
[class*="customify-grid-2"] > [class*="customify-col-"],
[class*="customify-grid-2"] > [class*="customify-col_"] {
  -ms-flex-preferred-size: 50%;
      flex-basis: 50%;
  max-width: 50%;
}

[class*="customify-grid-3"] > [class~="customify-col"],
[class*="customify-grid-3"] > [class*="customify-col-"],
[class*="customify-grid-3"] > [class*="customify-col_"] {
  -ms-flex-preferred-size: 33.3333333333%;
      flex-basis: 33.3333333333%;
  max-width: 33.3333333333%;
}

[class*="customify-grid-4"] > [class~="customify-col"],
[class*="customify-grid-4"] > [class*="customify-col-"],
[class*="customify-grid-4"] > [class*="customify-col_"] {
  -ms-flex-preferred-size: 25%;
      flex-basis: 25%;
  max-width: 25%;
}

[class*="customify-grid-5"] > [class~="customify-col"],
[class*="customify-grid-5"] > [class*="customify-col-"],
[class*="customify-grid-5"] > [class*="customify-col_"] {
  -ms-flex-preferred-size: 20%;
      flex-basis: 20%;
  max-width: 20%;
}

[class*="customify-grid-6"] > [class~="customify-col"],
[class*="customify-grid-6"] > [class*="customify-col-"],
[class*="customify-grid-6"] > [class*="customify-col_"] {
  -ms-flex-preferred-size: 16.6666666667%;
      flex-basis: 16.6666666667%;
  max-width: 16.6666666667%;
}

[class*="customify-grid-7"] > [class~="customify-col"],
[class*="customify-grid-7"] > [class*="customify-col-"],
[class*="customify-grid-7"] > [class*="customify-col_"] {
  -ms-flex-preferred-size: 14.2857142857%;
      flex-basis: 14.2857142857%;
  max-width: 14.2857142857%;
}

[class*="customify-grid-8"] > [class~="customify-col"],
[class*="customify-grid-8"] > [class*="customify-col-"],
[class*="customify-grid-8"] > [class*="customify-col_"] {
  -ms-flex-preferred-size: 12.5%;
      flex-basis: 12.5%;
  max-width: 12.5%;
}

[class*="customify-grid-9"] > [class~="customify-col"],
[class*="customify-grid-9"] > [class*="customify-col-"],
[class*="customify-grid-9"] > [class*="customify-col_"] {
  -ms-flex-preferred-size: 11.1111111111%;
      flex-basis: 11.1111111111%;
  max-width: 11.1111111111%;
}

[class*="customify-grid-10"] > [class~="customify-col"],
[class*="customify-grid-10"] > [class*="customify-col-"],
[class*="customify-grid-10"] > [class*="customify-col_"] {
  -ms-flex-preferred-size: 10%;
      flex-basis: 10%;
  max-width: 10%;
}

[class*="customify-grid-11"] > [class~="customify-col"],
[class*="customify-grid-11"] > [class*="customify-col-"] {
  -ms-flex-preferred-size: 9.0909090909%;
      flex-basis: 9.0909090909%;
  max-width: 9.0909090909%;
}

[class*="customify-grid-12"] > [class~="customify-col"],
[class*="customify-grid-12"] > [class*="customify-col-"],
[class*="customify-grid-12"] > [class*="customify-col_"] {
  -ms-flex-preferred-size: 8.3333333333%;
      flex-basis: 8.3333333333%;
  max-width: 8.3333333333%;
}

@media screen and (max-width: 80em) {
  [class*="_lg-1"] > [class~="customify-col"],
  [class*="_lg-1"] > [class*="customify-col-"],
  [class*="_lg-1"] > [class*="customify-col_"] {
    -ms-flex-preferred-size: 100%;
        flex-basis: 100%;
    max-width: 100%;
  }

  [class*="_lg-2"] > [class~="customify-col"],
  [class*="_lg-2"] > [class*="customify-col-"],
  [class*="_lg-2"] > [class*="customify-col_"] {
    -ms-flex-preferred-size: 50%;
        flex-basis: 50%;
    max-width: 50%;
  }

  [class*="_lg-3"] > [class~="customify-col"],
  [class*="_lg-3"] > [class*="customify-col-"],
  [class*="_lg-3"] > [class*="customify-col_"] {
    -ms-flex-preferred-size: 33.3333333333%;
        flex-basis: 33.3333333333%;
    max-width: 33.3333333333%;
  }

  [class*="_lg-4"] > [class~="customify-col"],
  [class*="_lg-4"] > [class*="customify-col-"],
  [class*="_lg-4"] > [class*="customify-col_"] {
    -ms-flex-preferred-size: 25%;
        flex-basis: 25%;
    max-width: 25%;
  }

  [class*="_lg-5"] > [class~="customify-col"],
  [class*="_lg-5"] > [class*="customify-col-"],
  [class*="_lg-5"] > [class*="customify-col_"] {
    -ms-flex-preferred-size: 20%;
        flex-basis: 20%;
    max-width: 20%;
  }

  [class*="_lg-6"] > [class~="customify-col"],
  [class*="_lg-6"] > [class*="customify-col-"],
  [class*="_lg-6"] > [class*="customify-col_"] {
    -ms-flex-preferred-size: 16.6666666667%;
        flex-basis: 16.6666666667%;
    max-width: 16.6666666667%;
  }

  [class*="_lg-7"] > [class~="customify-col"],
  [class*="_lg-7"] > [class*="customify-col-"],
  [class*="_lg-7"] > [class*="customify-col_"] {
    -ms-flex-preferred-size: 14.2857142857%;
        flex-basis: 14.2857142857%;
    max-width: 14.2857142857%;
  }

  [class*="_lg-8"] > [class~="customify-col"],
  [class*="_lg-8"] > [class*="customify-col-"],
  [class*="_lg-8"] > [class*="customify-col_"] {
    -ms-flex-preferred-size: 12.5%;
        flex-basis: 12.5%;
    max-width: 12.5%;
  }

  [class*="_lg-9"] > [class~="customify-col"],
  [class*="_lg-9"] > [class*="customify-col-"],
  [class*="_lg-9"] > [class*="customify-col_"] {
    -ms-flex-preferred-size: 11.1111111111%;
        flex-basis: 11.1111111111%;
    max-width: 11.1111111111%;
  }

  [class*="_lg-10"] > [class~="customify-col"],
  [class*="_lg-10"] > [class*="customify-col-"],
  [class*="_lg-10"] > [class*="customify-col_"] {
    -ms-flex-preferred-size: 10%;
        flex-basis: 10%;
    max-width: 10%;
  }

  [class*="_lg-11"] > [class~="customify-col"],
  [class*="_lg-11"] > [class*="customify-col-"] {
    -ms-flex-preferred-size: 9.0909090909%;
        flex-basis: 9.0909090909%;
    max-width: 9.0909090909%;
  }

  [class*="_lg-12"] > [class~="customify-col"],
  [class*="_lg-12"] > [class*="customify-col-"],
  [class*="_lg-12"] > [class*="customify-col_"] {
    -ms-flex-preferred-size: 8.3333333333%;
        flex-basis: 8.3333333333%;
    max-width: 8.3333333333%;
  }
}
@media screen and (max-width: 64em) {
  [class*="_md-1"] > [class~="customify-col"],
  [class*="_md-1"] > [class*="customify-col-"],
  [class*="_md-1"] > [class*="customify-col_"] {
    -ms-flex-preferred-size: 100%;
        flex-basis: 100%;
    max-width: 100%;
  }

  [class*="_md-2"] > [class~="customify-col"],
  [class*="_md-2"] > [class*="customify-col-"],
  [class*="_md-2"] > [class*="customify-col_"] {
    -ms-flex-preferred-size: 50%;
        flex-basis: 50%;
    max-width: 50%;
  }

  [class*="_md-3"] > [class~="customify-col"],
  [class*="_md-3"] > [class*="customify-col-"],
  [class*="_md-3"] > [class*="customify-col_"] {
    -ms-flex-preferred-size: 33.3333333333%;
        flex-basis: 33.3333333333%;
    max-width: 33.3333333333%;
  }

  [class*="_md-4"] > [class~="customify-col"],
  [class*="_md-4"] > [class*="customify-col-"],
  [class*="_md-4"] > [class*="customify-col_"] {
    -ms-flex-preferred-size: 25%;
        flex-basis: 25%;
    max-width: 25%;
  }

  [class*="_md-5"] > [class~="customify-col"],
  [class*="_md-5"] > [class*="customify-col-"],
  [class*="_md-5"] > [class*="customify-col_"] {
    -ms-flex-preferred-size: 20%;
        flex-basis: 20%;
    max-width: 20%;
  }

  [class*="_md-6"] > [class~="customify-col"],
  [class*="_md-6"] > [class*="customify-col-"],
  [class*="_md-6"] > [class*="customify-col_"] {
    -ms-flex-preferred-size: 16.6666666667%;
        flex-basis: 16.6666666667%;
    max-width: 16.6666666667%;
  }

  [class*="_md-7"] > [class~="customify-col"],
  [class*="_md-7"] > [class*="customify-col-"],
  [class*="_md-7"] > [class*="customify-col_"] {
    -ms-flex-preferred-size: 14.2857142857%;
        flex-basis: 14.2857142857%;
    max-width: 14.2857142857%;
  }

  [class*="_md-8"] > [class~="customify-col"],
  [class*="_md-8"] > [class*="customify-col-"],
  [class*="_md-8"] > [class*="customify-col_"] {
    -ms-flex-preferred-size: 12.5%;
        flex-basis: 12.5%;
    max-width: 12.5%;
  }

  [class*="_md-9"] > [class~="customify-col"],
  [class*="_md-9"] > [class*="customify-col-"],
  [class*="_md-9"] > [class*="customify-col_"] {
    -ms-flex-preferred-size: 11.1111111111%;
        flex-basis: 11.1111111111%;
    max-width: 11.1111111111%;
  }

  [class*="_md-10"] > [class~="customify-col"],
  [class*="_md-10"] > [class*="customify-col-"],
  [class*="_md-10"] > [class*="customify-col_"] {
    -ms-flex-preferred-size: 10%;
        flex-basis: 10%;
    max-width: 10%;
  }

  [class*="_md-11"] > [class~="customify-col"],
  [class*="_md-11"] > [class*="customify-col-"] {
    -ms-flex-preferred-size: 9.0909090909%;
        flex-basis: 9.0909090909%;
    max-width: 9.0909090909%;
  }

  [class*="_md-12"] > [class~="customify-col"],
  [class*="_md-12"] > [class*="customify-col-"],
  [class*="_md-12"] > [class*="customify-col_"] {
    -ms-flex-preferred-size: 8.3333333333%;
        flex-basis: 8.3333333333%;
    max-width: 8.3333333333%;
  }
}
@media screen and (max-width: 48em) {
  [class*="_sm-1"] > [class~="customify-col"],
  [class*="_sm-1"] > [class*="customify-col-"],
  [class*="_sm-1"] > [class*="customify-col_"] {
    -ms-flex-preferred-size: 100%;
        flex-basis: 100%;
    max-width: 100%;
  }

  [class*="_sm-2"] > [class~="customify-col"],
  [class*="_sm-2"] > [class*="customify-col-"],
  [class*="_sm-2"] > [class*="customify-col_"] {
    -ms-flex-preferred-size: 50%;
        flex-basis: 50%;
    max-width: 50%;
  }

  [class*="_sm-3"] > [class~="customify-col"],
  [class*="_sm-3"] > [class*="customify-col-"],
  [class*="_sm-3"] > [class*="customify-col_"] {
    -ms-flex-preferred-size: 33.3333333333%;
        flex-basis: 33.3333333333%;
    max-width: 33.3333333333%;
  }

  [class*="_sm-4"] > [class~="customify-col"],
  [class*="_sm-4"] > [class*="customify-col-"],
  [class*="_sm-4"] > [class*="customify-col_"] {
    -ms-flex-preferred-size: 25%;
        flex-basis: 25%;
    max-width: 25%;
  }

  [class*="_sm-5"] > [class~="customify-col"],
  [class*="_sm-5"] > [class*="customify-col-"],
  [class*="_sm-5"] > [class*="customify-col_"] {
    -ms-flex-preferred-size: 20%;
        flex-basis: 20%;
    max-width: 20%;
  }

  [class*="_sm-6"] > [class~="customify-col"],
  [class*="_sm-6"] > [class*="customify-col-"],
  [class*="_sm-6"] > [class*="customify-col_"] {
    -ms-flex-preferred-size: 16.6666666667%;
        flex-basis: 16.6666666667%;
    max-width: 16.6666666667%;
  }

  [class*="_sm-7"] > [class~="customify-col"],
  [class*="_sm-7"] > [class*="customify-col-"],
  [class*="_sm-7"] > [class*="customify-col_"] {
    -ms-flex-preferred-size: 14.2857142857%;
        flex-basis: 14.2857142857%;
    max-width: 14.2857142857%;
  }

  [class*="_sm-8"] > [class~="customify-col"],
  [class*="_sm-8"] > [class*="customify-col-"],
  [class*="_sm-8"] > [class*="customify-col_"] {
    -ms-flex-preferred-size: 12.5%;
        flex-basis: 12.5%;
    max-width: 12.5%;
  }

  [class*="_sm-9"] > [class~="customify-col"],
  [class*="_sm-9"] > [class*="customify-col-"],
  [class*="_sm-9"] > [class*="customify-col_"] {
    -ms-flex-preferred-size: 11.1111111111%;
        flex-basis: 11.1111111111%;
    max-width: 11.1111111111%;
  }

  [class*="_sm-10"] > [class~="customify-col"],
  [class*="_sm-10"] > [class*="customify-col-"],
  [class*="_sm-10"] > [class*="customify-col_"] {
    -ms-flex-preferred-size: 10%;
        flex-basis: 10%;
    max-width: 10%;
  }

  [class*="_sm-11"] > [class~="customify-col"],
  [class*="_sm-11"] > [class*="customify-col-"] {
    -ms-flex-preferred-size: 9.0909090909%;
        flex-basis: 9.0909090909%;
    max-width: 9.0909090909%;
  }

  [class*="_sm-12"] > [class~="customify-col"],
  [class*="_sm-12"] > [class*="customify-col-"],
  [class*="_sm-12"] > [class*="customify-col_"] {
    -ms-flex-preferred-size: 8.3333333333%;
        flex-basis: 8.3333333333%;
    max-width: 8.3333333333%;
  }
}
@media screen and (max-width: 35.5em) {
  [class*="_xs-1"] > [class~="customify-col"],
  [class*="_xs-1"] > [class*="customify-col-"],
  [class*="_xs-1"] > [class*="customify-col_"] {
    -ms-flex-preferred-size: 100%;
        flex-basis: 100%;
    max-width: 100%;
  }

  [class*="_xs-2"] > [class~="customify-col"],
  [class*="_xs-2"] > [class*="customify-col-"],
  [class*="_xs-2"] > [class*="customify-col_"] {
    -ms-flex-preferred-size: 50%;
        flex-basis: 50%;
    max-width: 50%;
  }

  [class*="_xs-3"] > [class~="customify-col"],
  [class*="_xs-3"] > [class*="customify-col-"],
  [class*="_xs-3"] > [class*="customify-col_"] {
    -ms-flex-preferred-size: 33.3333333333%;
        flex-basis: 33.3333333333%;
    max-width: 33.3333333333%;
  }

  [class*="_xs-4"] > [class~="customify-col"],
  [class*="_xs-4"] > [class*="customify-col-"],
  [class*="_xs-4"] > [class*="customify-col_"] {
    -ms-flex-preferred-size: 25%;
        flex-basis: 25%;
    max-width: 25%;
  }

  [class*="_xs-5"] > [class~="customify-col"],
  [class*="_xs-5"] > [class*="customify-col-"],
  [class*="_xs-5"] > [class*="customify-col_"] {
    -ms-flex-preferred-size: 20%;
        flex-basis: 20%;
    max-width: 20%;
  }

  [class*="_xs-6"] > [class~="customify-col"],
  [class*="_xs-6"] > [class*="customify-col-"],
  [class*="_xs-6"] > [class*="customify-col_"] {
    -ms-flex-preferred-size: 16.6666666667%;
        flex-basis: 16.6666666667%;
    max-width: 16.6666666667%;
  }

  [class*="_xs-7"] > [class~="customify-col"],
  [class*="_xs-7"] > [class*="customify-col-"],
  [class*="_xs-7"] > [class*="customify-col_"] {
    -ms-flex-preferred-size: 14.2857142857%;
        flex-basis: 14.2857142857%;
    max-width: 14.2857142857%;
  }

  [class*="_xs-8"] > [class~="customify-col"],
  [class*="_xs-8"] > [class*="customify-col-"],
  [class*="_xs-8"] > [class*="customify-col_"] {
    -ms-flex-preferred-size: 12.5%;
        flex-basis: 12.5%;
    max-width: 12.5%;
  }

  [class*="_xs-9"] > [class~="customify-col"],
  [class*="_xs-9"] > [class*="customify-col-"],
  [class*="_xs-9"] > [class*="customify-col_"] {
    -ms-flex-preferred-size: 11.1111111111%;
        flex-basis: 11.1111111111%;
    max-width: 11.1111111111%;
  }

  [class*="_xs-10"] > [class~="customify-col"],
  [class*="_xs-10"] > [class*="customify-col-"],
  [class*="_xs-10"] > [class*="customify-col_"] {
    -ms-flex-preferred-size: 10%;
        flex-basis: 10%;
    max-width: 10%;
  }

  [class*="_xs-11"] > [class~="customify-col"],
  [class*="_xs-11"] > [class*="customify-col-"] {
    -ms-flex-preferred-size: 9.0909090909%;
        flex-basis: 9.0909090909%;
    max-width: 9.0909090909%;
  }

  [class*="_xs-12"] > [class~="customify-col"],
  [class*="_xs-12"] > [class*="customify-col-"],
  [class*="_xs-12"] > [class*="customify-col_"] {
    -ms-flex-preferred-size: 8.3333333333%;
        flex-basis: 8.3333333333%;
    max-width: 8.3333333333%;
  }
}
/************************
    COLS SIZES
*************************/
[class~="customify-grid"] > [class*="customify-col-1"],
[class*="customify-grid-"] > [class*="customify-col-1"],
[class*="customify-grid_"] > [class*="customify-col-1"] {
  -ms-flex-preferred-size: 8.3333333333%;
      flex-basis: 8.3333333333%;
  max-width: 8.3333333333%;
}
[class~="customify-grid"] > [class*="customify-col-2"],
[class*="customify-grid-"] > [class*="customify-col-2"],
[class*="customify-grid_"] > [class*="customify-col-2"] {
  -ms-flex-preferred-size: 16.6666666667%;
      flex-basis: 16.6666666667%;
  max-width: 16.6666666667%;
}
[class~="customify-grid"] > [class*="customify-col-3"],
[class*="customify-grid-"] > [class*="customify-col-3"],
[class*="customify-grid_"] > [class*="customify-col-3"] {
  -ms-flex-preferred-size: 25%;
      flex-basis: 25%;
  max-width: 25%;
}
[class~="customify-grid"] > [class*="customify-col-4"],
[class*="customify-grid-"] > [class*="customify-col-4"],
[class*="customify-grid_"] > [class*="customify-col-4"] {
  -ms-flex-preferred-size: 33.3333333333%;
      flex-basis: 33.3333333333%;
  max-width: 33.3333333333%;
}
[class~="customify-grid"] > [class*="customify-col-5"],
[class*="customify-grid-"] > [class*="customify-col-5"],
[class*="customify-grid_"] > [class*="customify-col-5"] {
  -ms-flex-preferred-size: 41.6666666667%;
      flex-basis: 41.6666666667%;
  max-width: 41.6666666667%;
}
[class~="customify-grid"] > [class*="customify-col-6"],
[class*="customify-grid-"] > [class*="customify-col-6"],
[class*="customify-grid_"] > [class*="customify-col-6"] {
  -ms-flex-preferred-size: 50%;
      flex-basis: 50%;
  max-width: 50%;
}
[class~="customify-grid"] > [class*="customify-col-7"],
[class*="customify-grid-"] > [class*="customify-col-7"],
[class*="customify-grid_"] > [class*="customify-col-7"] {
  -ms-flex-preferred-size: 58.3333333333%;
      flex-basis: 58.3333333333%;
  max-width: 58.3333333333%;
}
[class~="customify-grid"] > [class*="customify-col-8"],
[class*="customify-grid-"] > [class*="customify-col-8"],
[class*="customify-grid_"] > [class*="customify-col-8"] {
  -ms-flex-preferred-size: 66.6666666667%;
      flex-basis: 66.6666666667%;
  max-width: 66.6666666667%;
}
[class~="customify-grid"] > [class*="customify-col-9"],
[class*="customify-grid-"] > [class*="customify-col-9"],
[class*="customify-grid_"] > [class*="customify-col-9"] {
  -ms-flex-preferred-size: 75%;
      flex-basis: 75%;
  max-width: 75%;
}
[class~="customify-grid"] > [class*="customify-col-10"],
[class*="customify-grid-"] > [class*="customify-col-10"],
[class*="customify-grid_"] > [class*="customify-col-10"] {
  -ms-flex-preferred-size: 83.3333333333%;
      flex-basis: 83.3333333333%;
  max-width: 83.3333333333%;
}
[class~="customify-grid"] > [class*="customify-col-11"],
[class*="customify-grid-"] > [class*="customify-col-11"],
[class*="customify-grid_"] > [class*="customify-col-11"] {
  -ms-flex-preferred-size: 91.6666666667%;
      flex-basis: 91.6666666667%;
  max-width: 91.6666666667%;
}
[class~="customify-grid"] > [class*="customify-col-12"],
[class*="customify-grid-"] > [class*="customify-col-12"],
[class*="customify-grid_"] > [class*="customify-col-12"] {
  -ms-flex-preferred-size: 100%;
      flex-basis: 100%;
  max-width: 100%;
}

[class~="customify-grid"] > [data-push-left*="off-0"],
[class*="customify-grid-"] > [data-push-left*="off-0"],
[class*="customify-grid_"] > [data-push-left*="off-0"] {
  margin-left: 0;
}
[class~="customify-grid"] > [data-push-left*="off-1"],
[class*="customify-grid-"] > [data-push-left*="off-1"],
[class*="customify-grid_"] > [data-push-left*="off-1"] {
  margin-left: 8.3333333333%;
}
[class~="customify-grid"] > [data-push-left*="off-2"],
[class*="customify-grid-"] > [data-push-left*="off-2"],
[class*="customify-grid_"] > [data-push-left*="off-2"] {
  margin-left: 16.6666666667%;
}
[class~="customify-grid"] > [data-push-left*="off-3"],
[class*="customify-grid-"] > [data-push-left*="off-3"],
[class*="customify-grid_"] > [data-push-left*="off-3"] {
  margin-left: 25%;
}
[class~="customify-grid"] > [data-push-left*="off-4"],
[class*="customify-grid-"] > [data-push-left*="off-4"],
[class*="customify-grid_"] > [data-push-left*="off-4"] {
  margin-left: 33.3333333333%;
}
[class~="customify-grid"] > [data-push-left*="off-5"],
[class*="customify-grid-"] > [data-push-left*="off-5"],
[class*="customify-grid_"] > [data-push-left*="off-5"] {
  margin-left: 41.6666666667%;
}
[class~="customify-grid"] > [data-push-left*="off-6"],
[class*="customify-grid-"] > [data-push-left*="off-6"],
[class*="customify-grid_"] > [data-push-left*="off-6"] {
  margin-left: 50%;
}
[class~="customify-grid"] > [data-push-left*="off-7"],
[class*="customify-grid-"] > [data-push-left*="off-7"],
[class*="customify-grid_"] > [data-push-left*="off-7"] {
  margin-left: 58.3333333333%;
}
[class~="customify-grid"] > [data-push-left*="off-8"],
[class*="customify-grid-"] > [data-push-left*="off-8"],
[class*="customify-grid_"] > [data-push-left*="off-8"] {
  margin-left: 66.6666666667%;
}
[class~="customify-grid"] > [data-push-left*="off-9"],
[class*="customify-grid-"] > [data-push-left*="off-9"],
[class*="customify-grid_"] > [data-push-left*="off-9"] {
  margin-left: 75%;
}
[class~="customify-grid"] > [data-push-left*="off-10"],
[class*="customify-grid-"] > [data-push-left*="off-10"],
[class*="customify-grid_"] > [data-push-left*="off-10"] {
  margin-left: 83.3333333333%;
}
[class~="customify-grid"] > [data-push-left*="off-11"],
[class*="customify-grid-"] > [data-push-left*="off-11"],
[class*="customify-grid_"] > [data-push-left*="off-11"] {
  margin-left: 91.6666666667%;
}
[class~="customify-grid"] > [data-push-right*="off-0"],
[class*="customify-grid-"] > [data-push-right*="off-0"],
[class*="customify-grid_"] > [data-push-right*="off-0"] {
  margin-right: 0;
}
[class~="customify-grid"] > [data-push-right*="off-1"],
[class*="customify-grid-"] > [data-push-right*="off-1"],
[class*="customify-grid_"] > [data-push-right*="off-1"] {
  margin-right: 8.3333333333%;
}
[class~="customify-grid"] > [data-push-right*="off-2"],
[class*="customify-grid-"] > [data-push-right*="off-2"],
[class*="customify-grid_"] > [data-push-right*="off-2"] {
  margin-right: 16.6666666667%;
}
[class~="customify-grid"] > [data-push-right*="off-3"],
[class*="customify-grid-"] > [data-push-right*="off-3"],
[class*="customify-grid_"] > [data-push-right*="off-3"] {
  margin-right: 25%;
}
[class~="customify-grid"] > [data-push-right*="off-4"],
[class*="customify-grid-"] > [data-push-right*="off-4"],
[class*="customify-grid_"] > [data-push-right*="off-4"] {
  margin-right: 33.3333333333%;
}
[class~="customify-grid"] > [data-push-right*="off-5"],
[class*="customify-grid-"] > [data-push-right*="off-5"],
[class*="customify-grid_"] > [data-push-right*="off-5"] {
  margin-right: 41.6666666667%;
}
[class~="customify-grid"] > [data-push-right*="off-6"],
[class*="customify-grid-"] > [data-push-right*="off-6"],
[class*="customify-grid_"] > [data-push-right*="off-6"] {
  margin-right: 50%;
}
[class~="customify-grid"] > [data-push-right*="off-7"],
[class*="customify-grid-"] > [data-push-right*="off-7"],
[class*="customify-grid_"] > [data-push-right*="off-7"] {
  margin-right: 58.3333333333%;
}
[class~="customify-grid"] > [data-push-right*="off-8"],
[class*="customify-grid-"] > [data-push-right*="off-8"],
[class*="customify-grid_"] > [data-push-right*="off-8"] {
  margin-right: 66.6666666667%;
}
[class~="customify-grid"] > [data-push-right*="off-9"],
[class*="customify-grid-"] > [data-push-right*="off-9"],
[class*="customify-grid_"] > [data-push-right*="off-9"] {
  margin-right: 75%;
}
[class~="customify-grid"] > [data-push-right*="off-10"],
[class*="customify-grid-"] > [data-push-right*="off-10"],
[class*="customify-grid_"] > [data-push-right*="off-10"] {
  margin-right: 83.3333333333%;
}
[class~="customify-grid"] > [data-push-right*="off-11"],
[class*="customify-grid-"] > [data-push-right*="off-11"],
[class*="customify-grid_"] > [data-push-right*="off-11"] {
  margin-right: 91.6666666667%;
}

@media screen and (max-width: 80em) {
  [class~="customify-grid"] > [class*="_lg-1"],
  [class*="customify-grid-"] > [class*="_lg-1"],
  [class*="customify-grid_"] > [class*="_lg-1"] {
    -ms-flex-preferred-size: 8.3333333333%;
        flex-basis: 8.3333333333%;
    max-width: 8.3333333333%;
  }
  [class~="customify-grid"] > [class*="_lg-2"],
  [class*="customify-grid-"] > [class*="_lg-2"],
  [class*="customify-grid_"] > [class*="_lg-2"] {
    -ms-flex-preferred-size: 16.6666666667%;
        flex-basis: 16.6666666667%;
    max-width: 16.6666666667%;
  }
  [class~="customify-grid"] > [class*="_lg-3"],
  [class*="customify-grid-"] > [class*="_lg-3"],
  [class*="customify-grid_"] > [class*="_lg-3"] {
    -ms-flex-preferred-size: 25%;
        flex-basis: 25%;
    max-width: 25%;
  }
  [class~="customify-grid"] > [class*="_lg-4"],
  [class*="customify-grid-"] > [class*="_lg-4"],
  [class*="customify-grid_"] > [class*="_lg-4"] {
    -ms-flex-preferred-size: 33.3333333333%;
        flex-basis: 33.3333333333%;
    max-width: 33.3333333333%;
  }
  [class~="customify-grid"] > [class*="_lg-5"],
  [class*="customify-grid-"] > [class*="_lg-5"],
  [class*="customify-grid_"] > [class*="_lg-5"] {
    -ms-flex-preferred-size: 41.6666666667%;
        flex-basis: 41.6666666667%;
    max-width: 41.6666666667%;
  }
  [class~="customify-grid"] > [class*="_lg-6"],
  [class*="customify-grid-"] > [class*="_lg-6"],
  [class*="customify-grid_"] > [class*="_lg-6"] {
    -ms-flex-preferred-size: 50%;
        flex-basis: 50%;
    max-width: 50%;
  }
  [class~="customify-grid"] > [class*="_lg-7"],
  [class*="customify-grid-"] > [class*="_lg-7"],
  [class*="customify-grid_"] > [class*="_lg-7"] {
    -ms-flex-preferred-size: 58.3333333333%;
        flex-basis: 58.3333333333%;
    max-width: 58.3333333333%;
  }
  [class~="customify-grid"] > [class*="_lg-8"],
  [class*="customify-grid-"] > [class*="_lg-8"],
  [class*="customify-grid_"] > [class*="_lg-8"] {
    -ms-flex-preferred-size: 66.6666666667%;
        flex-basis: 66.6666666667%;
    max-width: 66.6666666667%;
  }
  [class~="customify-grid"] > [class*="_lg-9"],
  [class*="customify-grid-"] > [class*="_lg-9"],
  [class*="customify-grid_"] > [class*="_lg-9"] {
    -ms-flex-preferred-size: 75%;
        flex-basis: 75%;
    max-width: 75%;
  }
  [class~="customify-grid"] > [class*="_lg-10"],
  [class*="customify-grid-"] > [class*="_lg-10"],
  [class*="customify-grid_"] > [class*="_lg-10"] {
    -ms-flex-preferred-size: 83.3333333333%;
        flex-basis: 83.3333333333%;
    max-width: 83.3333333333%;
  }
  [class~="customify-grid"] > [class*="_lg-11"],
  [class*="customify-grid-"] > [class*="_lg-11"],
  [class*="customify-grid_"] > [class*="_lg-11"] {
    -ms-flex-preferred-size: 91.6666666667%;
        flex-basis: 91.6666666667%;
    max-width: 91.6666666667%;
  }
  [class~="customify-grid"] > [class*="_lg-12"],
  [class*="customify-grid-"] > [class*="_lg-12"],
  [class*="customify-grid_"] > [class*="_lg-12"] {
    -ms-flex-preferred-size: 100%;
        flex-basis: 100%;
    max-width: 100%;
  }

  [class~="customify-grid"] > [data-push-left*="_lg-0"],
  [class*="customify-grid-"] > [data-push-left*="_lg-0"],
  [class*="customify-grid_"] > [data-push-left*="_lg-0"] {
    margin-left: 0;
  }
  [class~="customify-grid"] > [data-push-left*="_lg-1"],
  [class*="customify-grid-"] > [data-push-left*="_lg-1"],
  [class*="customify-grid_"] > [data-push-left*="_lg-1"] {
    margin-left: 8.3333333333%;
  }
  [class~="customify-grid"] > [data-push-left*="_lg-2"],
  [class*="customify-grid-"] > [data-push-left*="_lg-2"],
  [class*="customify-grid_"] > [data-push-left*="_lg-2"] {
    margin-left: 16.6666666667%;
  }
  [class~="customify-grid"] > [data-push-left*="_lg-3"],
  [class*="customify-grid-"] > [data-push-left*="_lg-3"],
  [class*="customify-grid_"] > [data-push-left*="_lg-3"] {
    margin-left: 25%;
  }
  [class~="customify-grid"] > [data-push-left*="_lg-4"],
  [class*="customify-grid-"] > [data-push-left*="_lg-4"],
  [class*="customify-grid_"] > [data-push-left*="_lg-4"] {
    margin-left: 33.3333333333%;
  }
  [class~="customify-grid"] > [data-push-left*="_lg-5"],
  [class*="customify-grid-"] > [data-push-left*="_lg-5"],
  [class*="customify-grid_"] > [data-push-left*="_lg-5"] {
    margin-left: 41.6666666667%;
  }
  [class~="customify-grid"] > [data-push-left*="_lg-6"],
  [class*="customify-grid-"] > [data-push-left*="_lg-6"],
  [class*="customify-grid_"] > [data-push-left*="_lg-6"] {
    margin-left: 50%;
  }
  [class~="customify-grid"] > [data-push-left*="_lg-7"],
  [class*="customify-grid-"] > [data-push-left*="_lg-7"],
  [class*="customify-grid_"] > [data-push-left*="_lg-7"] {
    margin-left: 58.3333333333%;
  }
  [class~="customify-grid"] > [data-push-left*="_lg-8"],
  [class*="customify-grid-"] > [data-push-left*="_lg-8"],
  [class*="customify-grid_"] > [data-push-left*="_lg-8"] {
    margin-left: 66.6666666667%;
  }
  [class~="customify-grid"] > [data-push-left*="_lg-9"],
  [class*="customify-grid-"] > [data-push-left*="_lg-9"],
  [class*="customify-grid_"] > [data-push-left*="_lg-9"] {
    margin-left: 75%;
  }
  [class~="customify-grid"] > [data-push-left*="_lg-10"],
  [class*="customify-grid-"] > [data-push-left*="_lg-10"],
  [class*="customify-grid_"] > [data-push-left*="_lg-10"] {
    margin-left: 83.3333333333%;
  }
  [class~="customify-grid"] > [data-push-left*="_lg-11"],
  [class*="customify-grid-"] > [data-push-left*="_lg-11"],
  [class*="customify-grid_"] > [data-push-left*="_lg-11"] {
    margin-left: 91.6666666667%;
  }
  [class~="customify-grid"] > [data-push-right*="_lg-0"],
  [class*="customify-grid-"] > [data-push-right*="_lg-0"],
  [class*="customify-grid_"] > [data-push-right*="_lg-0"] {
    margin-right: 0;
  }
  [class~="customify-grid"] > [data-push-right*="_lg-1"],
  [class*="customify-grid-"] > [data-push-right*="_lg-1"],
  [class*="customify-grid_"] > [data-push-right*="_lg-1"] {
    margin-right: 8.3333333333%;
  }
  [class~="customify-grid"] > [data-push-right*="_lg-2"],
  [class*="customify-grid-"] > [data-push-right*="_lg-2"],
  [class*="customify-grid_"] > [data-push-right*="_lg-2"] {
    margin-right: 16.6666666667%;
  }
  [class~="customify-grid"] > [data-push-right*="_lg-3"],
  [class*="customify-grid-"] > [data-push-right*="_lg-3"],
  [class*="customify-grid_"] > [data-push-right*="_lg-3"] {
    margin-right: 25%;
  }
  [class~="customify-grid"] > [data-push-right*="_lg-4"],
  [class*="customify-grid-"] > [data-push-right*="_lg-4"],
  [class*="customify-grid_"] > [data-push-right*="_lg-4"] {
    margin-right: 33.3333333333%;
  }
  [class~="customify-grid"] > [data-push-right*="_lg-5"],
  [class*="customify-grid-"] > [data-push-right*="_lg-5"],
  [class*="customify-grid_"] > [data-push-right*="_lg-5"] {
    margin-right: 41.6666666667%;
  }
  [class~="customify-grid"] > [data-push-right*="_lg-6"],
  [class*="customify-grid-"] > [data-push-right*="_lg-6"],
  [class*="customify-grid_"] > [data-push-right*="_lg-6"] {
    margin-right: 50%;
  }
  [class~="customify-grid"] > [data-push-right*="_lg-7"],
  [class*="customify-grid-"] > [data-push-right*="_lg-7"],
  [class*="customify-grid_"] > [data-push-right*="_lg-7"] {
    margin-right: 58.3333333333%;
  }
  [class~="customify-grid"] > [data-push-right*="_lg-8"],
  [class*="customify-grid-"] > [data-push-right*="_lg-8"],
  [class*="customify-grid_"] > [data-push-right*="_lg-8"] {
    margin-right: 66.6666666667%;
  }
  [class~="customify-grid"] > [data-push-right*="_lg-9"],
  [class*="customify-grid-"] > [data-push-right*="_lg-9"],
  [class*="customify-grid_"] > [data-push-right*="_lg-9"] {
    margin-right: 75%;
  }
  [class~="customify-grid"] > [data-push-right*="_lg-10"],
  [class*="customify-grid-"] > [data-push-right*="_lg-10"],
  [class*="customify-grid_"] > [data-push-right*="_lg-10"] {
    margin-right: 83.3333333333%;
  }
  [class~="customify-grid"] > [data-push-right*="_lg-11"],
  [class*="customify-grid-"] > [data-push-right*="_lg-11"],
  [class*="customify-grid_"] > [data-push-right*="_lg-11"] {
    margin-right: 91.6666666667%;
  }

  [class~="customify-grid"] [class*="_lg-first"],
  [class*="customify-grid-"] [class*="_lg-first"],
  [class*="customify-grid_"] [class*="_lg-first"] {
    -webkit-box-ordinal-group: 0;
        -ms-flex-order: -1;
            order: -1;
  }
  [class~="customify-grid"] [class*="_lg-last"],
  [class*="customify-grid-"] [class*="_lg-last"],
  [class*="customify-grid_"] [class*="_lg-last"] {
    -webkit-box-ordinal-group: 2;
        -ms-flex-order: 1;
            order: 1;
  }
}
@media screen and (max-width: 64em) {
  [class~="customify-grid"] > [class*="_md-1"],
  [class*="customify-grid-"] > [class*="_md-1"],
  [class*="customify-grid_"] > [class*="_md-1"] {
    -ms-flex-preferred-size: 8.3333333333%;
        flex-basis: 8.3333333333%;
    max-width: 8.3333333333%;
  }
  [class~="customify-grid"] > [class*="_md-2"],
  [class*="customify-grid-"] > [class*="_md-2"],
  [class*="customify-grid_"] > [class*="_md-2"] {
    -ms-flex-preferred-size: 16.6666666667%;
        flex-basis: 16.6666666667%;
    max-width: 16.6666666667%;
  }
  [class~="customify-grid"] > [class*="_md-3"],
  [class*="customify-grid-"] > [class*="_md-3"],
  [class*="customify-grid_"] > [class*="_md-3"] {
    -ms-flex-preferred-size: 25%;
        flex-basis: 25%;
    max-width: 25%;
  }
  [class~="customify-grid"] > [class*="_md-4"],
  [class*="customify-grid-"] > [class*="_md-4"],
  [class*="customify-grid_"] > [class*="_md-4"] {
    -ms-flex-preferred-size: 33.3333333333%;
        flex-basis: 33.3333333333%;
    max-width: 33.3333333333%;
  }
  [class~="customify-grid"] > [class*="_md-5"],
  [class*="customify-grid-"] > [class*="_md-5"],
  [class*="customify-grid_"] > [class*="_md-5"] {
    -ms-flex-preferred-size: 41.6666666667%;
        flex-basis: 41.6666666667%;
    max-width: 41.6666666667%;
  }
  [class~="customify-grid"] > [class*="_md-6"],
  [class*="customify-grid-"] > [class*="_md-6"],
  [class*="customify-grid_"] > [class*="_md-6"] {
    -ms-flex-preferred-size: 50%;
        flex-basis: 50%;
    max-width: 50%;
  }
  [class~="customify-grid"] > [class*="_md-7"],
  [class*="customify-grid-"] > [class*="_md-7"],
  [class*="customify-grid_"] > [class*="_md-7"] {
    -ms-flex-preferred-size: 58.3333333333%;
        flex-basis: 58.3333333333%;
    max-width: 58.3333333333%;
  }
  [class~="customify-grid"] > [class*="_md-8"],
  [class*="customify-grid-"] > [class*="_md-8"],
  [class*="customify-grid_"] > [class*="_md-8"] {
    -ms-flex-preferred-size: 66.6666666667%;
        flex-basis: 66.6666666667%;
    max-width: 66.6666666667%;
  }
  [class~="customify-grid"] > [class*="_md-9"],
  [class*="customify-grid-"] > [class*="_md-9"],
  [class*="customify-grid_"] > [class*="_md-9"] {
    -ms-flex-preferred-size: 75%;
        flex-basis: 75%;
    max-width: 75%;
  }
  [class~="customify-grid"] > [class*="_md-10"],
  [class*="customify-grid-"] > [class*="_md-10"],
  [class*="customify-grid_"] > [class*="_md-10"] {
    -ms-flex-preferred-size: 83.3333333333%;
        flex-basis: 83.3333333333%;
    max-width: 83.3333333333%;
  }
  [class~="customify-grid"] > [class*="_md-11"],
  [class*="customify-grid-"] > [class*="_md-11"],
  [class*="customify-grid_"] > [class*="_md-11"] {
    -ms-flex-preferred-size: 91.6666666667%;
        flex-basis: 91.6666666667%;
    max-width: 91.6666666667%;
  }
  [class~="customify-grid"] > [class*="_md-12"],
  [class*="customify-grid-"] > [class*="_md-12"],
  [class*="customify-grid_"] > [class*="_md-12"] {
    -ms-flex-preferred-size: 100%;
        flex-basis: 100%;
    max-width: 100%;
  }

  [class~="customify-grid"] > [data-push-left*="_md-0"],
  [class*="customify-grid-"] > [data-push-left*="_md-0"],
  [class*="customify-grid_"] > [data-push-left*="_md-0"] {
    margin-left: 0;
  }
  [class~="customify-grid"] > [data-push-left*="_md-1"],
  [class*="customify-grid-"] > [data-push-left*="_md-1"],
  [class*="customify-grid_"] > [data-push-left*="_md-1"] {
    margin-left: 8.3333333333%;
  }
  [class~="customify-grid"] > [data-push-left*="_md-2"],
  [class*="customify-grid-"] > [data-push-left*="_md-2"],
  [class*="customify-grid_"] > [data-push-left*="_md-2"] {
    margin-left: 16.6666666667%;
  }
  [class~="customify-grid"] > [data-push-left*="_md-3"],
  [class*="customify-grid-"] > [data-push-left*="_md-3"],
  [class*="customify-grid_"] > [data-push-left*="_md-3"] {
    margin-left: 25%;
  }
  [class~="customify-grid"] > [data-push-left*="_md-4"],
  [class*="customify-grid-"] > [data-push-left*="_md-4"],
  [class*="customify-grid_"] > [data-push-left*="_md-4"] {
    margin-left: 33.3333333333%;
  }
  [class~="customify-grid"] > [data-push-left*="_md-5"],
  [class*="customify-grid-"] > [data-push-left*="_md-5"],
  [class*="customify-grid_"] > [data-push-left*="_md-5"] {
    margin-left: 41.6666666667%;
  }
  [class~="customify-grid"] > [data-push-left*="_md-6"],
  [class*="customify-grid-"] > [data-push-left*="_md-6"],
  [class*="customify-grid_"] > [data-push-left*="_md-6"] {
    margin-left: 50%;
  }
  [class~="customify-grid"] > [data-push-left*="_md-7"],
  [class*="customify-grid-"] > [data-push-left*="_md-7"],
  [class*="customify-grid_"] > [data-push-left*="_md-7"] {
    margin-left: 58.3333333333%;
  }
  [class~="customify-grid"] > [data-push-left*="_md-8"],
  [class*="customify-grid-"] > [data-push-left*="_md-8"],
  [class*="customify-grid_"] > [data-push-left*="_md-8"] {
    margin-left: 66.6666666667%;
  }
  [class~="customify-grid"] > [data-push-left*="_md-9"],
  [class*="customify-grid-"] > [data-push-left*="_md-9"],
  [class*="customify-grid_"] > [data-push-left*="_md-9"] {
    margin-left: 75%;
  }
  [class~="customify-grid"] > [data-push-left*="_md-10"],
  [class*="customify-grid-"] > [data-push-left*="_md-10"],
  [class*="customify-grid_"] > [data-push-left*="_md-10"] {
    margin-left: 83.3333333333%;
  }
  [class~="customify-grid"] > [data-push-left*="_md-11"],
  [class*="customify-grid-"] > [data-push-left*="_md-11"],
  [class*="customify-grid_"] > [data-push-left*="_md-11"] {
    margin-left: 91.6666666667%;
  }
  [class~="customify-grid"] > [data-push-right*="_md-0"],
  [class*="customify-grid-"] > [data-push-right*="_md-0"],
  [class*="customify-grid_"] > [data-push-right*="_md-0"] {
    margin-right: 0;
  }
  [class~="customify-grid"] > [data-push-right*="_md-1"],
  [class*="customify-grid-"] > [data-push-right*="_md-1"],
  [class*="customify-grid_"] > [data-push-right*="_md-1"] {
    margin-right: 8.3333333333%;
  }
  [class~="customify-grid"] > [data-push-right*="_md-2"],
  [class*="customify-grid-"] > [data-push-right*="_md-2"],
  [class*="customify-grid_"] > [data-push-right*="_md-2"] {
    margin-right: 16.6666666667%;
  }
  [class~="customify-grid"] > [data-push-right*="_md-3"],
  [class*="customify-grid-"] > [data-push-right*="_md-3"],
  [class*="customify-grid_"] > [data-push-right*="_md-3"] {
    margin-right: 25%;
  }
  [class~="customify-grid"] > [data-push-right*="_md-4"],
  [class*="customify-grid-"] > [data-push-right*="_md-4"],
  [class*="customify-grid_"] > [data-push-right*="_md-4"] {
    margin-right: 33.3333333333%;
  }
  [class~="customify-grid"] > [data-push-right*="_md-5"],
  [class*="customify-grid-"] > [data-push-right*="_md-5"],
  [class*="customify-grid_"] > [data-push-right*="_md-5"] {
    margin-right: 41.6666666667%;
  }
  [class~="customify-grid"] > [data-push-right*="_md-6"],
  [class*="customify-grid-"] > [data-push-right*="_md-6"],
  [class*="customify-grid_"] > [data-push-right*="_md-6"] {
    margin-right: 50%;
  }
  [class~="customify-grid"] > [data-push-right*="_md-7"],
  [class*="customify-grid-"] > [data-push-right*="_md-7"],
  [class*="customify-grid_"] > [data-push-right*="_md-7"] {
    margin-right: 58.3333333333%;
  }
  [class~="customify-grid"] > [data-push-right*="_md-8"],
  [class*="customify-grid-"] > [data-push-right*="_md-8"],
  [class*="customify-grid_"] > [data-push-right*="_md-8"] {
    margin-right: 66.6666666667%;
  }
  [class~="customify-grid"] > [data-push-right*="_md-9"],
  [class*="customify-grid-"] > [data-push-right*="_md-9"],
  [class*="customify-grid_"] > [data-push-right*="_md-9"] {
    margin-right: 75%;
  }
  [class~="customify-grid"] > [data-push-right*="_md-10"],
  [class*="customify-grid-"] > [data-push-right*="_md-10"],
  [class*="customify-grid_"] > [data-push-right*="_md-10"] {
    margin-right: 83.3333333333%;
  }
  [class~="customify-grid"] > [data-push-right*="_md-11"],
  [class*="customify-grid-"] > [data-push-right*="_md-11"],
  [class*="customify-grid_"] > [data-push-right*="_md-11"] {
    margin-right: 91.6666666667%;
  }

  [class~="customify-grid"] [class*="_md-first"],
  [class*="customify-grid-"] [class*="_md-first"],
  [class*="customify-grid_"] [class*="_md-first"] {
    -webkit-box-ordinal-group: 0;
        -ms-flex-order: -1;
            order: -1;
  }
  [class~="customify-grid"] [class*="_md-last"],
  [class*="customify-grid-"] [class*="_md-last"],
  [class*="customify-grid_"] [class*="_md-last"] {
    -webkit-box-ordinal-group: 2;
        -ms-flex-order: 1;
            order: 1;
  }
}
@media screen and (max-width: 48em) {
  [class~="customify-grid"] > [class*="_sm-1"],
  [class*="customify-grid-"] > [class*="_sm-1"],
  [class*="customify-grid_"] > [class*="_sm-1"] {
    -ms-flex-preferred-size: 8.3333333333%;
        flex-basis: 8.3333333333%;
    max-width: 8.3333333333%;
  }
  [class~="customify-grid"] > [class*="_sm-2"],
  [class*="customify-grid-"] > [class*="_sm-2"],
  [class*="customify-grid_"] > [class*="_sm-2"] {
    -ms-flex-preferred-size: 16.6666666667%;
        flex-basis: 16.6666666667%;
    max-width: 16.6666666667%;
  }
  [class~="customify-grid"] > [class*="_sm-3"],
  [class*="customify-grid-"] > [class*="_sm-3"],
  [class*="customify-grid_"] > [class*="_sm-3"] {
    -ms-flex-preferred-size: 25%;
        flex-basis: 25%;
    max-width: 25%;
  }
  [class~="customify-grid"] > [class*="_sm-4"],
  [class*="customify-grid-"] > [class*="_sm-4"],
  [class*="customify-grid_"] > [class*="_sm-4"] {
    -ms-flex-preferred-size: 33.3333333333%;
        flex-basis: 33.3333333333%;
    max-width: 33.3333333333%;
  }
  [class~="customify-grid"] > [class*="_sm-5"],
  [class*="customify-grid-"] > [class*="_sm-5"],
  [class*="customify-grid_"] > [class*="_sm-5"] {
    -ms-flex-preferred-size: 41.6666666667%;
        flex-basis: 41.6666666667%;
    max-width: 41.6666666667%;
  }
  [class~="customify-grid"] > [class*="_sm-6"],
  [class*="customify-grid-"] > [class*="_sm-6"],
  [class*="customify-grid_"] > [class*="_sm-6"] {
    -ms-flex-preferred-size: 50%;
        flex-basis: 50%;
    max-width: 50%;
  }
  [class~="customify-grid"] > [class*="_sm-7"],
  [class*="customify-grid-"] > [class*="_sm-7"],
  [class*="customify-grid_"] > [class*="_sm-7"] {
    -ms-flex-preferred-size: 58.3333333333%;
        flex-basis: 58.3333333333%;
    max-width: 58.3333333333%;
  }
  [class~="customify-grid"] > [class*="_sm-8"],
  [class*="customify-grid-"] > [class*="_sm-8"],
  [class*="customify-grid_"] > [class*="_sm-8"] {
    -ms-flex-preferred-size: 66.6666666667%;
        flex-basis: 66.6666666667%;
    max-width: 66.6666666667%;
  }
  [class~="customify-grid"] > [class*="_sm-9"],
  [class*="customify-grid-"] > [class*="_sm-9"],
  [class*="customify-grid_"] > [class*="_sm-9"] {
    -ms-flex-preferred-size: 75%;
        flex-basis: 75%;
    max-width: 75%;
  }
  [class~="customify-grid"] > [class*="_sm-10"],
  [class*="customify-grid-"] > [class*="_sm-10"],
  [class*="customify-grid_"] > [class*="_sm-10"] {
    -ms-flex-preferred-size: 83.3333333333%;
        flex-basis: 83.3333333333%;
    max-width: 83.3333333333%;
  }
  [class~="customify-grid"] > [class*="_sm-11"],
  [class*="customify-grid-"] > [class*="_sm-11"],
  [class*="customify-grid_"] > [class*="_sm-11"] {
    -ms-flex-preferred-size: 91.6666666667%;
        flex-basis: 91.6666666667%;
    max-width: 91.6666666667%;
  }
  [class~="customify-grid"] > [class*="_sm-12"],
  [class*="customify-grid-"] > [class*="_sm-12"],
  [class*="customify-grid_"] > [class*="_sm-12"] {
    -ms-flex-preferred-size: 100%;
        flex-basis: 100%;
    max-width: 100%;
  }

  [class~="customify-grid"] > [data-push-left*="_sm-0"],
  [class*="customify-grid-"] > [data-push-left*="_sm-0"],
  [class*="customify-grid_"] > [data-push-left*="_sm-0"] {
    margin-left: 0;
  }
  [class~="customify-grid"] > [data-push-left*="_sm-1"],
  [class*="customify-grid-"] > [data-push-left*="_sm-1"],
  [class*="customify-grid_"] > [data-push-left*="_sm-1"] {
    margin-left: 8.3333333333%;
  }
  [class~="customify-grid"] > [data-push-left*="_sm-2"],
  [class*="customify-grid-"] > [data-push-left*="_sm-2"],
  [class*="customify-grid_"] > [data-push-left*="_sm-2"] {
    margin-left: 16.6666666667%;
  }
  [class~="customify-grid"] > [data-push-left*="_sm-3"],
  [class*="customify-grid-"] > [data-push-left*="_sm-3"],
  [class*="customify-grid_"] > [data-push-left*="_sm-3"] {
    margin-left: 25%;
  }
  [class~="customify-grid"] > [data-push-left*="_sm-4"],
  [class*="customify-grid-"] > [data-push-left*="_sm-4"],
  [class*="customify-grid_"] > [data-push-left*="_sm-4"] {
    margin-left: 33.3333333333%;
  }
  [class~="customify-grid"] > [data-push-left*="_sm-5"],
  [class*="customify-grid-"] > [data-push-left*="_sm-5"],
  [class*="customify-grid_"] > [data-push-left*="_sm-5"] {
    margin-left: 41.6666666667%;
  }
  [class~="customify-grid"] > [data-push-left*="_sm-6"],
  [class*="customify-grid-"] > [data-push-left*="_sm-6"],
  [class*="customify-grid_"] > [data-push-left*="_sm-6"] {
    margin-left: 50%;
  }
  [class~="customify-grid"] > [data-push-left*="_sm-7"],
  [class*="customify-grid-"] > [data-push-left*="_sm-7"],
  [class*="customify-grid_"] > [data-push-left*="_sm-7"] {
    margin-left: 58.3333333333%;
  }
  [class~="customify-grid"] > [data-push-left*="_sm-8"],
  [class*="customify-grid-"] > [data-push-left*="_sm-8"],
  [class*="customify-grid_"] > [data-push-left*="_sm-8"] {
    margin-left: 66.6666666667%;
  }
  [class~="customify-grid"] > [data-push-left*="_sm-9"],
  [class*="customify-grid-"] > [data-push-left*="_sm-9"],
  [class*="customify-grid_"] > [data-push-left*="_sm-9"] {
    margin-left: 75%;
  }
  [class~="customify-grid"] > [data-push-left*="_sm-10"],
  [class*="customify-grid-"] > [data-push-left*="_sm-10"],
  [class*="customify-grid_"] > [data-push-left*="_sm-10"] {
    margin-left: 83.3333333333%;
  }
  [class~="customify-grid"] > [data-push-left*="_sm-11"],
  [class*="customify-grid-"] > [data-push-left*="_sm-11"],
  [class*="customify-grid_"] > [data-push-left*="_sm-11"] {
    margin-left: 91.6666666667%;
  }
  [class~="customify-grid"] > [data-push-right*="_sm-0"],
  [class*="customify-grid-"] > [data-push-right*="_sm-0"],
  [class*="customify-grid_"] > [data-push-right*="_sm-0"] {
    margin-right: 0;
  }
  [class~="customify-grid"] > [data-push-right*="_sm-1"],
  [class*="customify-grid-"] > [data-push-right*="_sm-1"],
  [class*="customify-grid_"] > [data-push-right*="_sm-1"] {
    margin-right: 8.3333333333%;
  }
  [class~="customify-grid"] > [data-push-right*="_sm-2"],
  [class*="customify-grid-"] > [data-push-right*="_sm-2"],
  [class*="customify-grid_"] > [data-push-right*="_sm-2"] {
    margin-right: 16.6666666667%;
  }
  [class~="customify-grid"] > [data-push-right*="_sm-3"],
  [class*="customify-grid-"] > [data-push-right*="_sm-3"],
  [class*="customify-grid_"] > [data-push-right*="_sm-3"] {
    margin-right: 25%;
  }
  [class~="customify-grid"] > [data-push-right*="_sm-4"],
  [class*="customify-grid-"] > [data-push-right*="_sm-4"],
  [class*="customify-grid_"] > [data-push-right*="_sm-4"] {
    margin-right: 33.3333333333%;
  }
  [class~="customify-grid"] > [data-push-right*="_sm-5"],
  [class*="customify-grid-"] > [data-push-right*="_sm-5"],
  [class*="customify-grid_"] > [data-push-right*="_sm-5"] {
    margin-right: 41.6666666667%;
  }
  [class~="customify-grid"] > [data-push-right*="_sm-6"],
  [class*="customify-grid-"] > [data-push-right*="_sm-6"],
  [class*="customify-grid_"] > [data-push-right*="_sm-6"] {
    margin-right: 50%;
  }
  [class~="customify-grid"] > [data-push-right*="_sm-7"],
  [class*="customify-grid-"] > [data-push-right*="_sm-7"],
  [class*="customify-grid_"] > [data-push-right*="_sm-7"] {
    margin-right: 58.3333333333%;
  }
  [class~="customify-grid"] > [data-push-right*="_sm-8"],
  [class*="customify-grid-"] > [data-push-right*="_sm-8"],
  [class*="customify-grid_"] > [data-push-right*="_sm-8"] {
    margin-right: 66.6666666667%;
  }
  [class~="customify-grid"] > [data-push-right*="_sm-9"],
  [class*="customify-grid-"] > [data-push-right*="_sm-9"],
  [class*="customify-grid_"] > [data-push-right*="_sm-9"] {
    margin-right: 75%;
  }
  [class~="customify-grid"] > [data-push-right*="_sm-10"],
  [class*="customify-grid-"] > [data-push-right*="_sm-10"],
  [class*="customify-grid_"] > [data-push-right*="_sm-10"] {
    margin-right: 83.3333333333%;
  }
  [class~="customify-grid"] > [data-push-right*="_sm-11"],
  [class*="customify-grid-"] > [data-push-right*="_sm-11"],
  [class*="customify-grid_"] > [data-push-right*="_sm-11"] {
    margin-right: 91.6666666667%;
  }

  [class~="customify-grid"] [class*="_sm-first"],
  [class*="customify-grid-"] [class*="_sm-first"],
  [class*="customify-grid_"] [class*="_sm-first"] {
    -webkit-box-ordinal-group: 0;
        -ms-flex-order: -1;
            order: -1;
  }
  [class~="customify-grid"] [class*="_sm-last"],
  [class*="customify-grid-"] [class*="_sm-last"],
  [class*="customify-grid_"] [class*="_sm-last"] {
    -webkit-box-ordinal-group: 2;
        -ms-flex-order: 1;
            order: 1;
  }
}
@media screen and (max-width: 35.5em) {
  [class~="customify-grid"] > [class*="_xs-1"],
  [class*="customify-grid-"] > [class*="_xs-1"],
  [class*="customify-grid_"] > [class*="_xs-1"] {
    -ms-flex-preferred-size: 8.3333333333%;
        flex-basis: 8.3333333333%;
    max-width: 8.3333333333%;
  }
  [class~="customify-grid"] > [class*="_xs-2"],
  [class*="customify-grid-"] > [class*="_xs-2"],
  [class*="customify-grid_"] > [class*="_xs-2"] {
    -ms-flex-preferred-size: 16.6666666667%;
        flex-basis: 16.6666666667%;
    max-width: 16.6666666667%;
  }
  [class~="customify-grid"] > [class*="_xs-3"],
  [class*="customify-grid-"] > [class*="_xs-3"],
  [class*="customify-grid_"] > [class*="_xs-3"] {
    -ms-flex-preferred-size: 25%;
        flex-basis: 25%;
    max-width: 25%;
  }
  [class~="customify-grid"] > [class*="_xs-4"],
  [class*="customify-grid-"] > [class*="_xs-4"],
  [class*="customify-grid_"] > [class*="_xs-4"] {
    -ms-flex-preferred-size: 33.3333333333%;
        flex-basis: 33.3333333333%;
    max-width: 33.3333333333%;
  }
  [class~="customify-grid"] > [class*="_xs-5"],
  [class*="customify-grid-"] > [class*="_xs-5"],
  [class*="customify-grid_"] > [class*="_xs-5"] {
    -ms-flex-preferred-size: 41.6666666667%;
        flex-basis: 41.6666666667%;
    max-width: 41.6666666667%;
  }
  [class~="customify-grid"] > [class*="_xs-6"],
  [class*="customify-grid-"] > [class*="_xs-6"],
  [class*="customify-grid_"] > [class*="_xs-6"] {
    -ms-flex-preferred-size: 50%;
        flex-basis: 50%;
    max-width: 50%;
  }
  [class~="customify-grid"] > [class*="_xs-7"],
  [class*="customify-grid-"] > [class*="_xs-7"],
  [class*="customify-grid_"] > [class*="_xs-7"] {
    -ms-flex-preferred-size: 58.3333333333%;
        flex-basis: 58.3333333333%;
    max-width: 58.3333333333%;
  }
  [class~="customify-grid"] > [class*="_xs-8"],
  [class*="customify-grid-"] > [class*="_xs-8"],
  [class*="customify-grid_"] > [class*="_xs-8"] {
    -ms-flex-preferred-size: 66.6666666667%;
        flex-basis: 66.6666666667%;
    max-width: 66.6666666667%;
  }
  [class~="customify-grid"] > [class*="_xs-9"],
  [class*="customify-grid-"] > [class*="_xs-9"],
  [class*="customify-grid_"] > [class*="_xs-9"] {
    -ms-flex-preferred-size: 75%;
        flex-basis: 75%;
    max-width: 75%;
  }
  [class~="customify-grid"] > [class*="_xs-10"],
  [class*="customify-grid-"] > [class*="_xs-10"],
  [class*="customify-grid_"] > [class*="_xs-10"] {
    -ms-flex-preferred-size: 83.3333333333%;
        flex-basis: 83.3333333333%;
    max-width: 83.3333333333%;
  }
  [class~="customify-grid"] > [class*="_xs-11"],
  [class*="customify-grid-"] > [class*="_xs-11"],
  [class*="customify-grid_"] > [class*="_xs-11"] {
    -ms-flex-preferred-size: 91.6666666667%;
        flex-basis: 91.6666666667%;
    max-width: 91.6666666667%;
  }
  [class~="customify-grid"] > [class*="_xs-12"],
  [class*="customify-grid-"] > [class*="_xs-12"],
  [class*="customify-grid_"] > [class*="_xs-12"] {
    -ms-flex-preferred-size: 100%;
        flex-basis: 100%;
    max-width: 100%;
  }

  [class~="customify-grid"] > [data-push-left*="_xs-0"],
  [class*="customify-grid-"] > [data-push-left*="_xs-0"],
  [class*="customify-grid_"] > [data-push-left*="_xs-0"] {
    margin-left: 0;
  }
  [class~="customify-grid"] > [data-push-left*="_xs-1"],
  [class*="customify-grid-"] > [data-push-left*="_xs-1"],
  [class*="customify-grid_"] > [data-push-left*="_xs-1"] {
    margin-left: 8.3333333333%;
  }
  [class~="customify-grid"] > [data-push-left*="_xs-2"],
  [class*="customify-grid-"] > [data-push-left*="_xs-2"],
  [class*="customify-grid_"] > [data-push-left*="_xs-2"] {
    margin-left: 16.6666666667%;
  }
  [class~="customify-grid"] > [data-push-left*="_xs-3"],
  [class*="customify-grid-"] > [data-push-left*="_xs-3"],
  [class*="customify-grid_"] > [data-push-left*="_xs-3"] {
    margin-left: 25%;
  }
  [class~="customify-grid"] > [data-push-left*="_xs-4"],
  [class*="customify-grid-"] > [data-push-left*="_xs-4"],
  [class*="customify-grid_"] > [data-push-left*="_xs-4"] {
    margin-left: 33.3333333333%;
  }
  [class~="customify-grid"] > [data-push-left*="_xs-5"],
  [class*="customify-grid-"] > [data-push-left*="_xs-5"],
  [class*="customify-grid_"] > [data-push-left*="_xs-5"] {
    margin-left: 41.6666666667%;
  }
  [class~="customify-grid"] > [data-push-left*="_xs-6"],
  [class*="customify-grid-"] > [data-push-left*="_xs-6"],
  [class*="customify-grid_"] > [data-push-left*="_xs-6"] {
    margin-left: 50%;
  }
  [class~="customify-grid"] > [data-push-left*="_xs-7"],
  [class*="customify-grid-"] > [data-push-left*="_xs-7"],
  [class*="customify-grid_"] > [data-push-left*="_xs-7"] {
    margin-left: 58.3333333333%;
  }
  [class~="customify-grid"] > [data-push-left*="_xs-8"],
  [class*="customify-grid-"] > [data-push-left*="_xs-8"],
  [class*="customify-grid_"] > [data-push-left*="_xs-8"] {
    margin-left: 66.6666666667%;
  }
  [class~="customify-grid"] > [data-push-left*="_xs-9"],
  [class*="customify-grid-"] > [data-push-left*="_xs-9"],
  [class*="customify-grid_"] > [data-push-left*="_xs-9"] {
    margin-left: 75%;
  }
  [class~="customify-grid"] > [data-push-left*="_xs-10"],
  [class*="customify-grid-"] > [data-push-left*="_xs-10"],
  [class*="customify-grid_"] > [data-push-left*="_xs-10"] {
    margin-left: 83.3333333333%;
  }
  [class~="customify-grid"] > [data-push-left*="_xs-11"],
  [class*="customify-grid-"] > [data-push-left*="_xs-11"],
  [class*="customify-grid_"] > [data-push-left*="_xs-11"] {
    margin-left: 91.6666666667%;
  }
  [class~="customify-grid"] > [data-push-right*="_xs-0"],
  [class*="customify-grid-"] > [data-push-right*="_xs-0"],
  [class*="customify-grid_"] > [data-push-right*="_xs-0"] {
    margin-right: 0;
  }
  [class~="customify-grid"] > [data-push-right*="_xs-1"],
  [class*="customify-grid-"] > [data-push-right*="_xs-1"],
  [class*="customify-grid_"] > [data-push-right*="_xs-1"] {
    margin-right: 8.3333333333%;
  }
  [class~="customify-grid"] > [data-push-right*="_xs-2"],
  [class*="customify-grid-"] > [data-push-right*="_xs-2"],
  [class*="customify-grid_"] > [data-push-right*="_xs-2"] {
    margin-right: 16.6666666667%;
  }
  [class~="customify-grid"] > [data-push-right*="_xs-3"],
  [class*="customify-grid-"] > [data-push-right*="_xs-3"],
  [class*="customify-grid_"] > [data-push-right*="_xs-3"] {
    margin-right: 25%;
  }
  [class~="customify-grid"] > [data-push-right*="_xs-4"],
  [class*="customify-grid-"] > [data-push-right*="_xs-4"],
  [class*="customify-grid_"] > [data-push-right*="_xs-4"] {
    margin-right: 33.3333333333%;
  }
  [class~="customify-grid"] > [data-push-right*="_xs-5"],
  [class*="customify-grid-"] > [data-push-right*="_xs-5"],
  [class*="customify-grid_"] > [data-push-right*="_xs-5"] {
    margin-right: 41.6666666667%;
  }
  [class~="customify-grid"] > [data-push-right*="_xs-6"],
  [class*="customify-grid-"] > [data-push-right*="_xs-6"],
  [class*="customify-grid_"] > [data-push-right*="_xs-6"] {
    margin-right: 50%;
  }
  [class~="customify-grid"] > [data-push-right*="_xs-7"],
  [class*="customify-grid-"] > [data-push-right*="_xs-7"],
  [class*="customify-grid_"] > [data-push-right*="_xs-7"] {
    margin-right: 58.3333333333%;
  }
  [class~="customify-grid"] > [data-push-right*="_xs-8"],
  [class*="customify-grid-"] > [data-push-right*="_xs-8"],
  [class*="customify-grid_"] > [data-push-right*="_xs-8"] {
    margin-right: 66.6666666667%;
  }
  [class~="customify-grid"] > [data-push-right*="_xs-9"],
  [class*="customify-grid-"] > [data-push-right*="_xs-9"],
  [class*="customify-grid_"] > [data-push-right*="_xs-9"] {
    margin-right: 75%;
  }
  [class~="customify-grid"] > [data-push-right*="_xs-10"],
  [class*="customify-grid-"] > [data-push-right*="_xs-10"],
  [class*="customify-grid_"] > [data-push-right*="_xs-10"] {
    margin-right: 83.3333333333%;
  }
  [class~="customify-grid"] > [data-push-right*="_xs-11"],
  [class*="customify-grid-"] > [data-push-right*="_xs-11"],
  [class*="customify-grid_"] > [data-push-right*="_xs-11"] {
    margin-right: 91.6666666667%;
  }

  [class~="customify-grid"] [class*="_xs-first"],
  [class*="customify-grid-"] [class*="_xs-first"],
  [class*="customify-grid_"] [class*="_xs-first"] {
    -webkit-box-ordinal-group: 0;
        -ms-flex-order: -1;
            order: -1;
  }
  [class~="customify-grid"] [class*="_xs-last"],
  [class*="customify-grid-"] [class*="_xs-last"],
  [class*="customify-grid_"] [class*="_xs-last"] {
    -webkit-box-ordinal-group: 2;
        -ms-flex-order: 1;
            order: 1;
  }
}
/************************
    HIDING COLS
*************************/
/*[class*="customify-col-"]:not([class*="customify-grid"]):not([class*="customify-col-0"]) {
  display: block;
}
[class~="customify-grid"][class*="customify-col-"]:not([class*="customify-col-0"]) {
  display: flex;
}*/
[class*="customify-col-"][class*="customify-col-0"] {
  display: none;
}

@media screen and (max-width: 80em) {
  [class~="customify-grid"],
  [class*="customify-grid-"],
  [class*="customify-grid_"] {
    /*
          &:not([class*="_lg-0"]) {
            display: flex;
          }*/
  }
  [class~="customify-grid"] > :not([class*="_lg-0"]),
  [class*="customify-grid-"] > :not([class*="_lg-0"]),
  [class*="customify-grid_"] > :not([class*="_lg-0"]) {
    display: block;
  }
  [class~="customify-grid"] > [class*="_lg-0"],
  [class*="customify-grid-"] > [class*="_lg-0"],
  [class*="customify-grid_"] > [class*="_lg-0"] {
    display: none;
  }
}
@media screen and (max-width: 64em) {
  [class~="customify-grid"],
  [class*="customify-grid-"],
  [class*="customify-grid_"] {
    /*
          &:not([class*="_md-0"]) {
            display: flex;
          }*/
  }
  [class~="customify-grid"] > :not([class*="_md-0"]),
  [class*="customify-grid-"] > :not([class*="_md-0"]),
  [class*="customify-grid_"] > :not([class*="_md-0"]) {
    display: block;
  }
  [class~="customify-grid"] > [class*="_md-0"],
  [class*="customify-grid-"] > [class*="_md-0"],
  [class*="customify-grid_"] > [class*="_md-0"] {
    display: none;
  }
}
@media screen and (max-width: 48em) {
  [class~="customify-grid"],
  [class*="customify-grid-"],
  [class*="customify-grid_"] {
    /*
          &:not([class*="_sm-0"]) {
            display: flex;
          }*/
  }
  [class~="customify-grid"] > :not([class*="_sm-0"]),
  [class*="customify-grid-"] > :not([class*="_sm-0"]),
  [class*="customify-grid_"] > :not([class*="_sm-0"]) {
    display: block;
  }
  [class~="customify-grid"] > [class*="_sm-0"],
  [class*="customify-grid-"] > [class*="_sm-0"],
  [class*="customify-grid_"] > [class*="_sm-0"] {
    display: none;
  }
}
@media screen and (max-width: 35.5em) {
  [class~="customify-grid"],
  [class*="customify-grid-"],
  [class*="customify-grid_"] {
    /*
          &:not([class*="_xs-0"]) {
            display: flex;
          }*/
  }
  [class~="customify-grid"] > :not([class*="_xs-0"]),
  [class*="customify-grid-"] > :not([class*="_xs-0"]),
  [class*="customify-grid_"] > :not([class*="_xs-0"]) {
    display: block;
  }
  [class~="customify-grid"] > [class*="_xs-0"],
  [class*="customify-grid-"] > [class*="_xs-0"],
  [class*="customify-grid_"] > [class*="_xs-0"] {
    display: none;
  }
}


/********
Footer
********/
/* Site Footer */
.site-footer {
  position: relative;
  z-index: 10;
}
.site-footer .item--inner {
  width: 100%;
  max-width: 100%;
}

.footer-top .footer--row-inner {
  padding-top: 2em;
  padding-bottom: 2em;
}
.footer-top .light-mode {
  background: #f0f0f0;
}
.footer-top .dark-mode {
  background: #292929;
}

.footer-top .footer--row-inner {
  padding-top: 2.5em;
  padding-bottom: 2.5em;
}
.footer-top .light-mode {
  background: #f9f9f9;
}
.footer-top .dark-mode {
  background: #303030;
}

.footer-bottom .footer--row-inner {
  padding-top: 1.5em;
  padding-bottom: 1.5em;
}
@media screen and (max-width: 568px) {
  .footer-bottom .builder-item {
    margin-bottom: 1em;
  }
  .footer-bottom .builder-item:last-child {
    margin-bottom: 0;
  }
}
.footer-bottom .light-mode {
  background: #ededed;
}
.footer-bottom .dark-mode {
  background: #1a1a1a;
}

.footer--row-inner.light-mode {
  color: rgba(0, 0, 0, 0.6);
}
.footer--row-inner.light-mode .product_list_widget li {
  border-color: rgba(0, 0, 0, 0.08);
}
.footer--row-inner.dark-mode {
  color: rgba(255, 255, 255, 0.99);
}
.footer--row-inner.dark-mode a:not(.button) {
  color: rgba(255, 255, 255, 0.79);
}
.footer--row-inner.dark-mode a:not(.button):hover {
  color: rgba(255, 255, 255, 0.99);
}
.footer--row-inner.dark-mode .product_list_widget li {
  border-color: rgba(255, 255, 255, 0.08);
}
.footer--row-inner.dark-mode table tbody td,
.footer--row-inner.dark-mode table th {
  background: rgba(0, 0, 0, 0.08);
}

.footer--row.layout-fullwidth .customify-container {
  max-width: initial;
}
.footer--row .builder-item--group {
  -webkit-box-pack: start;
      -ms-flex-pack: start;
          justify-content: flex-start;
}
.footer--row .builder-item--group .item--inner {
  width: auto;
}
@media screen and (max-width: 1024px) {
  .footer--row .builder-item--group .item--inner {
    display: block;
    margin-bottom: 2em;
  }
  .footer--row .builder-item--group .item--inner:last-child {
    margin-bottom: 0px;
  }
}

.footer-top .builder-item:last-child, .footer-top .builder-item:last-child, .footer-bottom .builder-item:last-child {
  margin-bottom: 0;
}
.footer-top .builder-item .widget-area .widget:last-child, .footer-top .builder-item .widget-area .widget:last-child, .footer-bottom .builder-item .widget-area .widget:last-child {
  margin-bottom: 0;
}
@media screen and (max-width: 568px) {
  .footer-top .builder-item--footer_copyright,
  .footer-top .builder-item--footer-social-icons, .footer-top .builder-item--footer_copyright,
  .footer-top .builder-item--footer-social-icons, .footer-bottom .builder-item--footer_copyright,
  .footer-bottom .builder-item--footer-social-icons {
    text-align: center;
  }
}

@media screen and (max-width: 48em) {
  .site-footer .builder-item {
    margin-bottom: 2em;
  }
}
.site-footer p:last-child {
  margin-bottom: 0px;
}
.site-footer ul, .site-footer li {
  list-style: none;
  margin: 0px;
}
.site-footer ul ul {
  margin-left: 2.617924em;
}

.footer-copyright {
  font-size: 0.875em;
}

[class~="customify-grid"], [class*="customify-grid-"], [class*="customify-grid_"] {
    box-sizing: border-box;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: horizontal;
    -webkit-box-direction: normal;
    -ms-flex-flow: row wrap;
    flex-flow: row wrap;
    margin: 0 -1em;
}
.customify-container {
    position: relative;
    padding-left: 2em;
    padding-right: 2em;
}
/*.customify-container, .layout-contained {
    max-width: 1248px;
    margin: 0 auto;
}*/

/************************
    HIDING COLS FOR DEVICES
*************************/
@media screen and (min-width: 1025px) {
  .hide-on-desktop,
  .customify-grid .hide-on-desktop {
    display: none;
  }

  .align-left-desktop {
    text-align: left;
  }

  .align-center-desktop {
    text-align: center;
  }

  .align-right-desktop {
    text-align: right;
  }
}
@media screen and (max-width: 1024px) {
  .hide-on-tablet,
  .customify-grid .hide-on-tablet {
    display: none;
  }

  .align-left-tablet {
    text-align: left;
  }

  .align-center-tablet {
    text-align: center;
  }

  .align-right-tablet {
    text-align: right;
  }
}
@media screen and (max-width: 568px) {
  .hide-on-mobile,
  .customify-grid .hide-on-mobile {
    display: none;
  }

  .align-left-mobile {
    text-align: left;
  }

  .align-center-mobile {
    text-align: center;
  }

  .align-right-mobile {
    text-align: right;
  }
}
.header-bottom {
    background: #f0f0f0;
    box-shadow: 0 1px 2px 0 #e1e5ea;
}

/*********************
.hamburger
**********************/
header .hamburger {
  padding: 0;
  display: inline-block;
  cursor: pointer;
  -webkit-transition-property: opacity, -webkit-filter;
  transition-property: opacity, -webkit-filter;
  transition-property: opacity, filter;
  transition-property: opacity, filter, -webkit-filter;
  -webkit-transition-duration: 0.15s;
          transition-duration: 0.15s;
  -webkit-transition-timing-function: linear;
          transition-timing-function: linear;
  font: inherit;
  color: inherit;
  text-transform: none;
  background-color: transparent;
  border: 0;
  margin: 0;
  overflow: visible;
}

header .hamburger-box {
  display: inline-block;
  position: relative;
  vertical-align: middle;
}

header .hamburger-inner {
  display: block;
  top: 50%;
  background-color: currentcolor;
}
header .hamburger-inner, .hamburger-inner::before, .hamburger-inner::after {
  border-radius: 0px;
  position: absolute;
  -webkit-transition-property: -webkit-transform;
  transition-property: -webkit-transform;
  transition-property: transform;
  transition-property: transform, -webkit-transform;
  -webkit-transition-duration: 0.15s;
          transition-duration: 0.15s;
  -webkit-transition-timing-function: ease;
          transition-timing-function: ease;
}
header .hamburger-inner::before, .hamburger-inner::after {
  content: " ";
  display: block;
  background-color: inherit;
}

header .is-size-small .hamburger .hamburger-box {
  margin-top: -2px;
  width: 19px;
}
header .is-size-small .hamburger .hamburger-inner {
  margin-top: -1px;
}
header .is-size-small .hamburger .hamburger-inner, .is-size-small .hamburger .hamburger-inner::before, .is-size-small .hamburger .hamburger-inner::after {
  width: 19px;
  height: 2px;
}
header .is-size-small .hamburger .hamburger-inner::before {
  top: -6px;
}
header .is-size-small .hamburger .hamburger-inner::after {
  bottom: -6px;
}

header .is-size-medium .hamburger .hamburger-box {
  margin-top: -2px;
  width: 22px;
}
header .is-size-medium .hamburger .hamburger-inner {
  margin-top: -1px;
}
header .is-size-medium .hamburger .hamburger-inner, .is-size-medium .hamburger .hamburger-inner::before, .is-size-medium .hamburger .hamburger-inner::after {
  width: 22px;
  height: 2px;
}
header .is-size-medium .hamburger .hamburger-inner::before {
  top: -7px;
}
header .is-size-medium .hamburger .hamburger-inner::after {
  bottom: -7px;
}

header .is-size-large .hamburger .hamburger-box {
  margin-top: -2px;
  width: 31px;
}
header .is-size-large .hamburger .hamburger-inner {
  margin-top: -1.5px;
}
header .is-size-large .hamburger .hamburger-inner, .is-size-large .hamburger .hamburger-inner::before, .is-size-large .hamburger .hamburger-inner::after {
  width: 31px;
  height: 3px;
}
header .is-size-large .hamburger .hamburger-inner::before {
  top: -9px;
}
header .is-size-large .hamburger .hamburger-inner::after {
  bottom: -9px;
}

@media screen and (min-width: 1025px) {
  header .is-size-desktop-small .hamburger .hamburger-box {
    margin-top: -2px;
    width: 19px;
  }
  header .is-size-desktop-small .hamburger .hamburger-inner {
    margin-top: -1px;
  }
  header .is-size-desktop-small .hamburger .hamburger-inner, .is-size-desktop-small .hamburger .hamburger-inner::before, .is-size-desktop-small .hamburger .hamburger-inner::after {
    width: 19px;
    height: 2px;
  }
  header .is-size-desktop-small .hamburger .hamburger-inner::before {
    top: -6px;
  }
  header .is-size-desktop-small .hamburger .hamburger-inner::after {
    bottom: -6px;
  }

  header .is-size-desktop-medium .hamburger .hamburger-box {
    margin-top: -2px;
    width: 22px;
  }
  header .is-size-desktop-medium .hamburger .hamburger-inner {
    margin-top: -1px;
  }
  .is-size-desktop-medium .hamburger .hamburger-inner, .is-size-desktop-medium .hamburger .hamburger-inner::before, .is-size-desktop-medium .hamburger .hamburger-inner::after {
    width: 22px;
    height: 2px;
  }
  header .is-size-desktop-medium .hamburger .hamburger-inner::before {
    top: -7px;
  }
  header .is-size-desktop-medium .hamburger .hamburger-inner::after {
    bottom: -7px;
  }

  header .is-size-desktop-large .hamburger .hamburger-box {
    margin-top: -2px;
    width: 31px;
  }
  header .is-size-desktop-large .hamburger .hamburger-inner {
    margin-top: -1.5px;
  }
  header .is-size-desktop-large .hamburger .hamburger-inner, .is-size-desktop-large .hamburger .hamburger-inner::before, .is-size-desktop-large .hamburger .hamburger-inner::after {
    width: 31px;
    height: 3px;
  }
  header .is-size-desktop-large .hamburger .hamburger-inner::before {
    top: -9px;
  }
  header .is-size-desktop-large .hamburger .hamburger-inner::after {
    bottom: -9px;
  }
}
@media screen and (max-width: 1024px) {
  header .is-size-tablet-small .hamburger .hamburger-box {
    margin-top: -2px;
    width: 19px;
  }
  header .is-size-tablet-small .hamburger .hamburger-inner {
    margin-top: -1px;
  }
  header .is-size-tablet-small .hamburger .hamburger-inner, .is-size-tablet-small .hamburger .hamburger-inner::before, .is-size-tablet-small .hamburger .hamburger-inner::after {
    width: 19px;
    height: 2px;
  }
  header .is-size-tablet-small .hamburger .hamburger-inner::before {
    top: -6px;
  }
  header .is-size-tablet-small .hamburger .hamburger-inner::after {
    bottom: -6px;
  }

  header .is-size-tablet-medium .hamburger .hamburger-box {
    margin-top: -2px;
    width: 22px;
  }
  header .is-size-tablet-medium .hamburger .hamburger-inner {
    margin-top: -1px;
  }
  header .is-size-tablet-medium .hamburger .hamburger-inner, .is-size-tablet-medium .hamburger .hamburger-inner::before, .is-size-tablet-medium .hamburger .hamburger-inner::after {
    width: 22px;
    height: 2px;
  }
  header .is-size-tablet-medium .hamburger .hamburger-inner::before {
    top: -7px;
  }
  header .is-size-tablet-medium .hamburger .hamburger-inner::after {
    bottom: -7px;
  }

  header .is-size-tablet-large .hamburger .hamburger-box {
    margin-top: -2px;
    width: 31px;
  }
  header .is-size-tablet-large .hamburger .hamburger-inner {
    margin-top: -1.5px;
  }
  header .is-size-tablet-large .hamburger .hamburger-inner, .is-size-tablet-large .hamburger .hamburger-inner::before, .is-size-tablet-large .hamburger .hamburger-inner::after {
    width: 31px;
    height: 3px;
  }
  header .is-size-tablet-large .hamburger .hamburger-inner::before {
    top: -9px;
  }
  header .is-size-tablet-large .hamburger .hamburger-inner::after {
    bottom: -9px;
  }
}
@media screen and (max-width: 568px) {
  header .is-size-mobile-small .hamburger .hamburger-box {
    margin-top: -2px;
    width: 19px;
  }
  header .is-size-mobile-small .hamburger .hamburger-inner {
    margin-top: -1px;
  }
  header .is-size-mobile-small .hamburger .hamburger-inner, .is-size-mobile-small .hamburger .hamburger-inner::before, .is-size-mobile-small .hamburger .hamburger-inner::after {
    width: 19px;
    height: 2px;
  }
  header .is-size-mobile-small .hamburger .hamburger-inner::before {
    top: -6px;
  }
  header .is-size-mobile-small .hamburger .hamburger-inner::after {
    bottom: -6px;
  }

  header .is-size-mobile-medium .hamburger .hamburger-box {
    margin-top: -2px;
    width: 22px;
  }
  header .is-size-mobile-medium .hamburger .hamburger-inner {
    margin-top: -1px;
  }
  header .is-size-mobile-medium .hamburger .hamburger-inner, .is-size-mobile-medium .hamburger .hamburger-inner::before, .is-size-mobile-medium .hamburger .hamburger-inner::after {
    width: 22px;
    height: 2px;
  }
  header .is-size-mobile-medium .hamburger .hamburger-inner::before {
    top: -7px;
  }
  header .is-size-mobile-medium .hamburger .hamburger-inner::after {
    bottom: -7px;
  }

  header .is-size-mobile-large .hamburger .hamburger-box {
    margin-top: -2px;
    width: 31px;
  }
  header .is-size-mobile-large .hamburger .hamburger-inner {
    margin-top: -1.5px;
  }
  header .is-size-mobile-large .hamburger .hamburger-inner, .is-size-mobile-large .hamburger .hamburger-inner::before, .is-size-mobile-large .hamburger .hamburger-inner::after {
    width: 31px;
    height: 3px;
  }
  header .is-size-mobile-large .hamburger .hamburger-inner::before {
    top: -9px;
  }
  header .is-size-mobile-large .hamburger .hamburger-inner::after {
    bottom: -9px;
  }
}
/*
* Squeeze
*/
header .hamburger--squeeze .hamburger-inner {
  -webkit-transition-duration: 0.075s;
          transition-duration: 0.075s;
  -webkit-transition-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
          transition-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
}
header .hamburger--squeeze .hamburger-inner::before {
  -webkit-transition: top 0.075s 0.12s ease, opacity 0.075s ease;
  transition: top 0.075s 0.12s ease, opacity 0.075s ease;
}
header .hamburger--squeeze .hamburger-inner::after {
  -webkit-transition: bottom 0.075s 0.12s ease, -webkit-transform 0.075s cubic-bezier(0.55, 0.055, 0.675, 0.19);
  transition: bottom 0.075s 0.12s ease, -webkit-transform 0.075s cubic-bezier(0.55, 0.055, 0.675, 0.19);
  transition: bottom 0.075s 0.12s ease, transform 0.075s cubic-bezier(0.55, 0.055, 0.675, 0.19);
  transition: bottom 0.075s 0.12s ease, transform 0.075s cubic-bezier(0.55, 0.055, 0.675, 0.19), -webkit-transform 0.075s cubic-bezier(0.55, 0.055, 0.675, 0.19);
}
header .hamburger--squeeze.is-active .hamburger-inner {
  -webkit-transform: rotate(45deg);
      -ms-transform: rotate(45deg);
          transform: rotate(45deg);
  -webkit-transition-delay: 0.12s;
          transition-delay: 0.12s;
  -webkit-transition-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
          transition-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
}
header .hamburger--squeeze.is-active .hamburger-inner::before {
  top: 0;
  opacity: 0;
  -webkit-transition: top 0.075s ease, opacity 0.075s 0.12s ease;
  transition: top 0.075s ease, opacity 0.075s 0.12s ease;
}
header .hamburger--squeeze.is-active .hamburger-inner::after {
  bottom: 0;
  -webkit-transform: rotate(-90deg);
      -ms-transform: rotate(-90deg);
          transform: rotate(-90deg);
  -webkit-transition: bottom 0.075s ease, -webkit-transform 0.075s 0.12s cubic-bezier(0.215, 0.61, 0.355, 1);
  transition: bottom 0.075s ease, -webkit-transform 0.075s 0.12s cubic-bezier(0.215, 0.61, 0.355, 1);
  transition: bottom 0.075s ease, transform 0.075s 0.12s cubic-bezier(0.215, 0.61, 0.355, 1);
  transition: bottom 0.075s ease, transform 0.075s 0.12s cubic-bezier(0.215, 0.61, 0.355, 1), -webkit-transform 0.075s 0.12s cubic-bezier(0.215, 0.61, 0.355, 1);
}




/* Showing Menu Sidebar animation. */
.is-menu-sidebar, .is-mobile-form-panel {
  overflow-x: hidden;
}

.is-menu-sidebar .header-menu-sidebar {
  overflow: auto;
}
.is-menu-sidebar.menu_sidebar_slide_overlay {
  overflow: initial;
  position: relative;
  width: 100%;
  display: block;
}
.is-menu-sidebar.menu_sidebar_slide_overlay .header-menu-sidebar {
  z-index: 999900;
  opacity: 1;
  visibility: visible;
}
.is-menu-sidebar.menu_sidebar_slide_overlay .menu-mobile-toggle {
  opacity: 0;
}
.is-menu-sidebar.menu_sidebar_slide_left {
  overflow: initial;
  position: relative;
  width: 100%;
  display: block;
}
.is-menu-sidebar.menu_sidebar_slide_left .header-menu-sidebar {
  z-index: 999900;
  height: 100%;
  -webkit-transform: translate3d(0, 0, 0);
          transform: translate3d(0, 0, 0);
  left: 0;
  visibility: visible;
}
.is-menu-sidebar.menu_sidebar_slide_left .menu-mobile-toggle {
  opacity: 0;
}
.is-menu-sidebar.menu_sidebar_slide_right {
  overflow: initial;
  position: relative;
  width: 100%;
  display: block;
}
.is-menu-sidebar.menu_sidebar_slide_right .header-menu-sidebar {
  z-index: 999900;
  height: 100%;
  max-width: 100vh;
  -webkit-transform: translate3d(0, 0, 0);
          transform: translate3d(0, 0, 0);
  right: 0;
  visibility: visible;
}
.is-menu-sidebar.menu_sidebar_slide_right .menu-mobile-toggle {
  opacity: 0;
}
.is-menu-sidebar.menu_sidebar_dropdown .header-menu-sidebar {
  z-index: 10;
  visibility: visible;
}

/* Close Button */
.close-sidebar-panel {
  display: none;
  z-index: 999910;
  cursor: pointer;
  position: fixed;
  top: 10px;
  right: 12px;
}
.close-sidebar-panel .hamburger-inner {
  background: rgba(255, 255, 255, 0.99);
}
.close-sidebar-panel .hamburger-inner:before, .close-sidebar-panel .hamburger-inner::after {
  background: inherit;
}
.close-sidebar-panel:hover .hamburger-inner {
  background: rgba(255, 255, 255, 0.99);
}

.menu_sidebar_slide_right .close-sidebar-panel {
  top: 10px;
  right: auto;
  left: 12px;
}

.menu_sidebar_dropdown .close-sidebar-panel {
  display: none !important;
}

.is-menu-sidebar:before, .is-mobile-form-panel:before {
  z-index: 999897;
  visibility: visible;
  opacity: 1;
}
.is-menu-sidebar .close-sidebar-panel, .is-mobile-form-panel .close-sidebar-panel {
  display: inline-block;
}

/* - Item showing animation  */
.header-menu-sidebar .item--inner {
  -webkit-transition: opacity .3s, -webkit-transform .3s;
  transition: opacity .3s, -webkit-transform .3s;
  transition: transform .3s, opacity .3s;
  transition: transform .3s, opacity .3s, -webkit-transform .3s;
  -webkit-transform: translateY(45px);
      -ms-transform: translateY(45px);
          transform: translateY(45px);
  opacity: 0;
}

.is-menu-sidebar .header-menu-sidebar .item--inner, .is-mobile-form-panel .header-menu-sidebar .item--inner {
  opacity: 1;
  -webkit-transform: translateY(0);
      -ms-transform: translateY(0);
          transform: translateY(0);
}

.cb-row--mobile {
  padding: 0 0.5em 0;
}
.cb-row--mobile [class~="customify-col"], .cb-row--mobile [class*="customify-col-"], .cb-row--mobile [class*="customify-col_"] {
  padding: 0 0.5em 0;
}


/*************
/*Footer
/*************/
.footer-bottom{
    background: #303030;
}
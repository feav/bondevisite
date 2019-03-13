<div ng-controller="result" id="result" class="bar-circle-block ">
   <div  class="valuer-sub-menu">
      <ul class="estimation-menu">
         <li class="active"><a > Estimation</a></li>
         <!-- <li><a ><i class="bdv-icon-app-Inscrease"></i> Évolution</a></li> -->
         <li><a ><i class="bdv-icon-app-PinMap"></i> Comparatif</a></li>
         <li class="ng-star-inserted"><a ><i class="bdv-icon-app-Dynamics"></i> Rentabilité</a></li>
         <li class="ng-star-inserted"><a ><i class="bdv-icon-app-Tax"></i> Financement</a></li>
         <li><a ><i class="bdv-icon-app-GlobalNotation"></i> Évaluation immobilière</a></li>
      </ul>
   </div>
   <div class="prince-row">
      <div class="valuer-result-global-estimation">
         <div class="estimation-fourchette-min">
            <h3 class="">Fourchette basse</h3>
            <h1 class="price">{{estimation_min}}€</h1>
         </div>
         <div class="estimation-center">
            <h3 class="">Le montant du loyer avec charges est estimé à</h3>
            <h1 class="price center">{{estimation_val}}€</h1>
         </div>
         <div class="estimation-fourchette-max">
            <h3 class="">Fourchette haute</h3>
            <h1 class="price">{{estimation_max}}€</h1>
         </div>
      </div>
   </div>
   <div class="dropdown-box center-horizontal">
      <h2 class="main-title">A virer.</h2>
      <p>Estimation de la rentabilité brute annuelle sur ce bien</p>
      <div class="holder-box-comp">
         <div class="bar-box-estimation">
            <div id="rent-min">0%</div>
            <span>Minimum</span>
         </div>
         <div class="bar-box-estimation">
            <div  id="rent-max">0%</div>
            <span>Maximum</span>
         </div>
      </div>
   </div>
   <div class="dropdown-box center-horizontal bar-graphe-integration">
      <h2 class="main-title">Financement</h2>
      <p class="help-text"><strong>Mensualité d'emprunt
         </strong>
         <br>Estimation réalisée à partir des moyennes du marché. Réalisez une estimation relative à votre situation personnelle auprès de notre partenaire : <a href="https://www.panoranet.com/assurance-pret/formulaire/ade.php?pagevoulue=ade_projet&code=SU1MEK">Estimer le coût de mon crédit</a>
      </p>
      <div class="holder" id="emprunt-mensualite">
         <div class="bar cf _10"  data-percent="{{0|percentage:800}}%">
            <span class="label">Sur 10 ans</span>
         </div>
         <div class="bar cf _15" data-percent="{{0|percentage:800}}%">
            <span class="label light">Sur 15 ans</span>
         </div>
         <div class="bar cf _20" data-percent="{{0|percentage:800}}%">
            <span class="label">Sur 20 ans</span>
         </div>
      </div>
      <BR>
      <p class="help-text"><strong>Frais estimés (en €)
         </strong>
         <br>Indication du prix d’achat du bien « acte en main » (hors coût du crédit)
      </p>
      <div class="financement-barcircle" >
         <div class="progress--circle progress--0" id="financement-frais-notariaux">
            <div class="progress__number" style="color: black;font-size: large;"><span>0</span>%<br>Frais notariaux ...</div>
         </div>
         <div class="progress--circle progress--0"  id="financement-frais-agence">
            <div class="progress__number" style="color: black;font-size: large;"><span>0</span>%<br>Frais d'agence ...</div>
         </div>
      </div>
   </div>
   <div class="dropdown-box center-horizontal">
      <h2 class="main-title">Évaluation géolocalisée d’emplacement</h2>
      <p class="help-text">Nous évaluons de manière objective le bien et son environnement sur un ensemble de critères économiques, sociaux-démographiques, et environnementaux.</p>
      <div class="content-dropdown">
         <div class="maping-box">


    <div id="widget-bdv" data-key="votre clé" data-input='{"address":"9pijlrvbTs9mtDQ7UN2r1UvTgnf9XlozeFPxtdhN4Zs","floor":"2","rooms":"4","surface":"40"}' data-option='{"score":true,"luminosity":true,"quietness":true,"proximity":true,"pollution":true,"connectivity":true,"safety":true,"individualtax":true,"dynamics":true,"rent":true,"sell":true,"rates":true,"mapPermanent":true,"sensitiveAddress":true}' style="margin:0 auto; height:400px; width:100%; border:1px solid #eee; border-radius: 5px;"></div>         </div>
      </div>
   </div>
</div>
<style type="text/css">
   p.help-text {
   line-height: initial;
   font-size: medium;
   margin-bottom: 5vh;
   margin-top: 2vh;
   }
   .main-title{
   text-align: left;
   line-height: 35px;
   font-weight: 500;
   }
</style>
<style type="text/css">
   .api-bdv .styled-input-single {
   position: relative;
   padding: 20px 0 20px 40px;
   text-align: left;
   }
   .api-bdv .styled-input-single label {
   cursor: pointer;
   }
   .api-bdv .styled-input-single label:before, .api-bdv .styled-input-single label:after {
   content: '';
   position: absolute;
   top: 50%;
   border-radius: 50%;
   }
   .api-bdv .styled-input-single label:before {
   left: 0;
   width: 30px;
   height: 30px;
   margin: -15px 0 0;
   background: #f7f7f7;
   box-shadow: 0 0 1px grey;
   }
   .api-bdv .styled-input-single label:after {
   left: 5px;
   width: 20px;
   height: 20px;
   margin: -10px 0 0;
   opacity: 0;
   background: #37b2b2;
   -webkit-transform: translate3d(-40px, 0, 0) scale(0.5);
   transform: translate3d(-40px, 0, 0) scale(0.5);
   transition: opacity 0.25s ease-in-out, -webkit-transform 0.25s ease-in-out;
   transition: opacity 0.25s ease-in-out, transform 0.25s ease-in-out;
   transition: opacity 0.25s ease-in-out, transform 0.25s ease-in-out, -webkit-transform 0.25s ease-in-out;
   }
   .api-bdv .styled-input-single input[type="radio"],
   .api-bdv .styled-input-single input[type="checkbox"] {
   position: absolute;
   top: 0;
   left: -9999px;
   visibility: hidden;
   }
   .api-bdv .styled-input-single input[type="radio"]:checked + label:after,
   .api-bdv .styled-input-single input[type="checkbox"]:checked + label:after {
   -webkit-transform: translate3d(0, 0, 0);
   transform: translate3d(0, 0, 0);
   opacity: 1;
   }
   .api-bdv .styled-input--square label:before, .api-bdv .styled-input--square label:after {
   border-radius: 0;
   }
   .api-bdv .styled-input--rounded label:before {
   border-radius: 10px;
   }
   .api-bdv .styled-input--rounded label:after {
   border-radius: 6px;
   }
   .api-bdv .styled-input--diamond .styled-input-single {
   padding-left: 45px;
   }
   .api-bdv .styled-input--diamond label:before, .api-bdv .styled-input--diamond label:after {
   border-radius: 0;
   }
   .api-bdv .styled-input--diamond label:before {
   -webkit-transform: rotate(45deg);
   transform: rotate(45deg);
   }
   .api-bdv .styled-input--diamond input[type="radio"]:checked + label:after,
   .api-bdv .styled-input--diamond input[type="checkbox"]:checked + label:after {
   -webkit-transform: rotate(45deg);
   transform: rotate(45deg);
   opacity: 1;
   }
   .api-bdv body {
   font-family: sans-serif;
   max-width: 400px;
   margin: 0 auto;
   padding: 30px;
   font-family: 'Maven Pro', sans-serif;
   text-align: center;
   }
   .api-bdv h1 {
   font-size: 2.8rem;
   }
   .api-bdv h2 {
   font-size: 2rem;
   }
   .api-bdv h1, .api-bdv h2 {
   font-family: 'Yrsa', cursive;
   }
   .api-bdv p {
   font-size: 1.25rem;
   line-height: 1.75rem;
   }
   .api-bdv hr {
   margin: 40px auto;
   max-width: 100px;
   display: block;
   height: 1px;
   border: 0;
   border-top: 1px solid #ccc;
   padding: 0;
   }
   .api-bdv .pen-intro {
   text-align: center;
   }
   .api-bdv .two-column:after {
   content: "";
   display: table;
   clear: both;
   }
   .api-bdv .two-column {
   margin: 0 0 40px;
   }
   @media (min-width: 860px) {
   .api-bdv .two-column {
   display: flex;
   }
   }
   .api-bdv .two-column .single-col {
   margin: 0 0 40px;
   }
   @media (min-width: 860px) {
   .api-bdv .two-column .single-col {
   width: 47.5%;
   float: left;
   margin: 0 0 0 5%;
   }
   .api-bdv .two-column .single-col:nth-child(2n+1) {
   clear: both;
   margin: 0;
   }
   }
</style>
<style type="text/css">
   .holder-box-comp{
   display: flex;
   width: 95%
   }
   .holder-box-comp > div{
   min-height: 165px;
   width: 48%;
   border-radius: 5px;
   color: black;
   background: #567dab;
   margin: 3%;
   padding: 7% 3%;
   -webkit-transition: opacity .2s ease-in-out;
   transition: opacity .2s ease-in-out;
   }
   .holder-box-comp > div > div{
   font-size: 3.5em;
   }
   .holder-box-comp > div > span{
   display: block;
   font-family: Raleway,sans-serif;
   }
   .holder-box-comp > div:hover{
   opacity: .8;
   }
   .financement-barcircle{
   display: flex;
   justify-content: center;
   }
   .list-good-item{
   color: rgb(130, 217, 200); clip: rect(0px, 38px, 20px, 0px); display: flex;    margin: 5px;
   }
   .big-box-info{
   display: flex;
   justify-content: center;
   flex-direction: column;
   min-height: 310px;
   }
   .small-box-info{
   display: flex;
   justify-content: center;
   flex-direction: row;
   }
   .bad-mark{
   color: #d0caca;
   }
   div.bdv-page-title {
   background-color: rgba(27, 188, 155, 0.2);
   font-size: 12px;
   color: rgb(99, 208, 186);
   border-radius: 5px!important;
   box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2), 0 0px 0 rgba(0, 0, 0, 0.02);
   text-align: center;
   margin-top: 5px;
   padding: 5px 0 5px 0;
   text-transform: uppercase;
   }
   .bdv-page-title-text.bdv-color {
   font-size: medium;
   line-height: 35px;
   }
   .bdv-title-rate {
   display: flex;
   justify-content: space-between;
   }
   .bdv-dot.bdv-transitall{
   color: rgb(99, 208, 186); 
   background-color: rgba(0, 0, 0, 0); 
   font-weight: normal; box-shadow: inherit;
   }
   .bdv-title-rate > div{
   color: rgb(99, 208, 186); display: block;
   }
   #result{
   padding: 25px;
   }
   .maping-box{
   display: flex;
   width: 100%;
   }
   .maping-box .map{
   width: 30%;
   min-height: 400PX;
   border-radius: 5px;
   }
   .maping-box .infos{
   width: 70%;
   }
</style>
<style type="text/css">
   .prince-row{
   display: flex;
   justify-content: center;
   margin-top: 50px;
   }
   .valuer-result-global-estimation h3 {
   font-size: 8pt;
   font-weight: 500;
   font-family: 'Open Sans',sans-serif;
   margin: 0 0 12px;
   color: #9f9f9f;
   text-align: center;
   }
   .valuer-result-global-estimation h1 {
   font-family: 'Work Sans',sans-serif;
   font-size: 16pt;
   font-weight: 700;
   color: #5277a399;
   margin: 0;
   }
   .valuer-result-global-estimation  h1.center {
   font-family: 'Work Sans',sans-serif;
   font-size: 25pt;
   font-weight: 700;
   color: #5277a3;
   margin: 0;
   }
   ul.estimation-menu li {
   padding: 20px 10px;
   margin-right: 20px;
   cursor: pointer;
   border-bottom: 0 solid #5277a3;
   list-style: none;
   line-height: 0px;
   }
   ul.estimation-menu li.active{
   border-bottom: 3px solid #5277a3;
   }
   ul.estimation-menu li:hover{
   border-bottom: 3px solid #5277a3;
   }
   ul.estimation-menu li a{    
   font-size: 10pt;
   cursor: pointer;
   color: #909094 !important;
   font-family: 'Open sans',sans-serif;
   font-weight: 700;
   letter-spacing: -.4px;
   text-decoration: none;
   -webkit-transition: .2s ease-in;
   transition: .2s ease-in;
   }
   ul.estimation-menu li:hover a{
   color: black !important;
   }
   ul.estimation-menu {
   display: flex;
   }
   div.valuer-result-global-estimation .price{
   text-align: center;
   }
   div.valuer-result-global-estimation{
   display: -webkit-box;
   display: -ms-flexbox;
   display: flex;
   -webkit-box-align: center;
   -ms-flex-align: center;
   align-items: center;
   -webkit-box-pack: space-evenly;
   -ms-flex-pack: space-evenly;
   justify-content: space-evenly;
   -webkit-box-orient: horizontal;
   -webkit-box-direction: normal;
   -ms-flex-direction: row;
   flex-direction: row;
   background: #fff;
   -webkit-box-shadow: 0 12px 40px 7px rgba(0,0,0,.1);
   box-shadow: 0 12px 40px 7px rgba(0,0,0,.1);
   border-radius: 10px;
   color: #fff;
   padding: 30px;
   width: 75%;
   }
</style>
<style type="text/css">
   .geolocIcon{
   float: right;color: black;
   }
   .geolocIcon i.fas{
   font-size: x-small;color: black;
   }
   .step-estimation{
   display: none;
   }
   .active.step-estimation{
   display: none;
   font-family: 'Nunito', sans-serif;
   }
   .center-horizontal{
   display: flex;
   flex-direction: column;
   justify-content: center;
   }
   .center-vertical{
   display: flex;
   flex-direction: row;
   justify-content: center;
   }
   #choiceWhere{
   display: flex;
   border-radius: 5px;
   background: white;
   transition: ease background 1s;
   display: flex;
   justify-content: center;
   }
   #choiceWhere.bg-grad{
   background: white;
   }
   #choiceWhere .form-select{
   width: 100%;
   position: relative;
   display: flex;
   justify-content: center;
   }
   #choiceWhere .form-bg{
   width: 40%;
   /*display: flex;*/
   /*justify-content: center;*/
   }
   #choiceWhere .form-bg img{
   width: 80%;
   border-radius: 5px;
   margin: 10%;
   }
   .content-dropdown{
   width: 100%;
   position: relative;
   }
   .dropdown-box{
   margin-top: 15px;
   width: 100%;
   position: relative;
   }
   .img-help{
   width: 30%;
   float: right;
   }
   .content-dropdown .menu .item{
   line-height: 35px;
   padding: 5px;
   padding-left: 25px;
   }
   button.default.text {
   margin-top: 45px;
   padding: 0 20px;
   color: #fff;
   background: #5277a3;
   -webkit-box-shadow: 0 8px 40px 0 rgb(86, 125, 171);
   box-shadow: 0 8px 40px 0 rgb(86, 125, 171);
   border: none;
   height: 40px;
   border-radius: 3.5px;
   -webkit-transition: .3s ease-in;
   transition: .3s ease-in;
   }
   button.default.text:hover{
   transform: scale(1.15);
   }
   button.default.text , .content-dropdown .menu .item:hover{
   background: #567dab;
   color: white;
   }
   .ui.dropdown input{
   width: 65%;
   background: #ffffff00;
   color: black;
   font-weight: 200;
   font-size: medium;font-family: 'Nunito', sans-serif;
   }
   @media only screen and (max-width: 600px) {
   #choiceWhere{
   flex-direction: column;
   }
   #choiceWhere .form-select,#choiceWhere .form-bg {
   width: 100%;
   }
   }
</style>
<style type="text/css">
   @import url(https://fonts.googleapis.com/css?family=Roboto:700,400,300);
   .bar-circle-block {
   /* Progress Bars */
   /**
   * $step is set to 5 by default, meaning you can only use percentage classes in increments of five (e.g. 25, 30, 45, 50, and so on). This helps to reduce the size of the final CSS file. If you need a number that doesn't end in 0 or 5, you can change the text percentage while rounding the class up/down to the nearest 5.
   */
   }
   .bar-circle-block bo
   * {
   box-sizing: border-box;
   }
   .bar-circle-block body {
   font-family: Roboto;
   background-color: #e7e7e7;
   color: #555;
   line-height: 1.4;
   }
   .bar-circle-block .container {
   width: 70%;
   padding: 2rem;
   margin: 100px auto;
   background-color: white;
   }
   .bar-circle-block .container h1 {
   text-align: center;
   }
   .bar-circle-block .bars {
   text-align: center;
   margin-top: 2rem;
   }
   .bar-circle-block .progress--bar {
   height: 1.5rem;
   margin: 1rem;
   background-color: #ddd;
   }
   .bar-circle-block .progress--bar:after {
   content: '';
   display: block;
   height: 100%;
   background-color: #5277a3;
   }
   .bar-circle-block .progress--circle {
   position: relative;
   display: inline-block;
   margin: 1rem;
   width: 120px;
   height: 120px;
   border-radius: 50%;
   background-color: #ddd;
   }
   .bar-circle-block .progress--circle:before {
   content: '';
   position: absolute;
   top: 5%;
   left: 5%;
   width: 90%;
   height: 90%;
   border-radius: 100%;
   background-color: white;
   }
   .bar-circle-block .progress--circle:after {
   content: '';
   display: inline-block;
   width: 100%;
   height: 100%;
   border-radius: 50%;
   background-color: #5277a3;
   }
   .bar-circle-block .progress__number {
   position: absolute;
   top: 44%;
   width: 100%;
   line-height: 1;
   margin-top: -0.75rem;
   text-align: center;
   font-size: xx-large;
   color: rgb(130, 217, 200);
   }
   .bar-circle-block .progress--pie:before {
   display: none;
   /* Get rid of white circle for "pie chart style" meter */
   }
   .bar-circle-block .progress--pie .progress__number {
   color: white;
   text-shadow: rgba(0, 0, 0, 0.35) 1px 1px 1px;
   }
   .bar-circle-block .progress--bar.progress--0:after {
   width: 0%;
   }
   .bar-circle-block .progress--circle.progress--0:after {
   background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(90deg, #5277a3 50%, #ddd 50%, #ddd);
   }
   .bar-circle-block .progress--bar.progress--5:after {
   width: 5%;
   }
   .bar-circle-block .progress--circle.progress--5:after {
   background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(108deg, #5277a3 50%, #ddd 50%, #ddd);
   }
   .bar-circle-block .progress--bar.progress--10:after {
   width: 10%;
   }
   .bar-circle-block .progress--circle.progress--10:after {
   background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(126deg, #5277a3 50%, #ddd 50%, #ddd);
   }
   .bar-circle-block .progress--bar.progress--15:after {
   width: 15%;
   }
   .bar-circle-block .progress--circle.progress--15:after {
   background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(144deg, #5277a3 50%, #ddd 50%, #ddd);
   }
   .bar-circle-block .progress--bar.progress--20:after {
   width: 20%;
   }
   .bar-circle-block .progress--circle.progress--20:after {
   background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(162deg, #5277a3 50%, #ddd 50%, #ddd);
   }
   .bar-circle-block .progress--bar.progress--25:after {
   width: 25%;
   }
   .bar-circle-block .progress--circle.progress--25:after {
   background-image: linear-gradient(90deg, #fff 50%, transparent 50%, transparent), linear-gradient(180deg, #5277a3 50%, #fff 50%, #fff);.bar-circle-block .progress--circle:before
   }
   .bar-circle-block .progress--bar.progress--30:after {
   width: 30%;
   }
   .bar-circle-block .progress--circle.progress--30:after {
   background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(198deg, #5277a3 50%, #ddd 50%, #ddd);
   }
   .bar-circle-block .progress--bar.progress--35:after {
   width: 35%;
   }
   .bar-circle-block .progress--circle.progress--35:after {
   background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(216deg, #5277a3 50%, #ddd 50%, #ddd);
   }
   .bar-circle-block .progress--bar.progress--40:after {
   width: 40%;
   }
   .bar-circle-block .progress--circle.progress--40:after {
   background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(234deg, #5277a3 50%, #ddd 50%, #ddd);
   }
   .bar-circle-block .progress--bar.progress--45:after {
   width: 45%;
   }
   .bar-circle-block .progress--circle.progress--45:after {
   background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(252deg, #5277a3 50%, #ddd 50%, #ddd);
   }
   .bar-circle-block .progress--bar.progress--50:after {
   width: 50%;
   }
   .bar-circle-block .progress--circle.progress--50:after {
   background-image: linear-gradient(-90deg, #5277a3 50%, transparent 50%, transparent), linear-gradient(270deg, #5277a3 50%, #ddd 50%, #ddd);
   }
   .bar-circle-block .progress--bar.progress--55:after {
   width: 55%;
   }
   .bar-circle-block .progress--circle.progress--55:after {
   background-image: linear-gradient(-72deg, #5277a3 50%, transparent 50%, transparent), linear-gradient(270deg, #5277a3 50%, #fff 50%, #fff);
   }
   .bar-circle-block .progress--bar.progress--60:after {
   width: 60%;
   }
   .bar-circle-block .progress--circle.progress--60:after {
   background-image: linear-gradient(-54deg, #5277a3 50%, transparent 50%, transparent), linear-gradient(270deg, #5277a3 50%, #ddd 50%, #ddd);
   }
   .bar-circle-block .progress--bar.progress--65:after {
   width: 65%;
   }
   .bar-circle-block .progress--circle.progress--65:after {
   background-image: linear-gradient(-36deg, #5277a3 50%, transparent 50%, transparent), linear-gradient(270deg, #5277a3 50%, #ddd 50%, #ddd);
   }
   .bar-circle-block .progress--bar.progress--70:after {
   width: 70%;
   }
   .bar-circle-block .progress--circle.progress--70:after {
   background-image: linear-gradient(-18deg, #5277a3 50%, transparent 50%, transparent), linear-gradient(270deg, #5277a3 50%, #ddd 50%, #ddd);
   }
   .bar-circle-block .progress--bar.progress--75:after {
   width: 75%;
   }
   .bar-circle-block .progress--circle.progress--75:after {
   background-image: linear-gradient(0deg, #5277a3 50%, transparent 50%, transparent), linear-gradient(270deg, #5277a3 50%, #ddd 50%, #ddd);
   }
   .bar-circle-block .progress--bar.progress--80:after {
   width: 80%;
   }
   .bar-circle-block .progress--circle.progress--80:after {
   background-image: linear-gradient(18deg, #5277a3 50%, transparent 50%, transparent), linear-gradient(270deg, #5277a3 50%, #ddd 50%, #ddd);
   }
   .bar-circle-block .progress--bar.progress--85:after {
   width: 85%;
   }
   .bar-circle-block .progress--circle.progress--85:after {
   background-image: linear-gradient(36deg, #5277a3 50%, transparent 50%, transparent), linear-gradient(270deg, #5277a3 50%, #ddd 50%, #ddd);
   }
   .bar-circle-block .progress--bar.progress--90:after {
   width: 90%;
   }
   .bar-circle-block .progress--circle.progress--90:after {
   background-image: linear-gradient(54deg, #5277a3 50%, transparent 50%, transparent), linear-gradient(270deg, #5277a3 50%, #ddd 50%, #ddd);
   }
   .bar-circle-block .progress--bar.progress--95:after {
   width: 95%;
   }
   .bar-circle-block .progress--circle.progress--95:after {
   background-image: linear-gradient(72deg, #5277a3 50%, transparent 50%, transparent), linear-gradient(270deg, #5277a3 50%, #ddd 50%, #ddd);
   }
   .bar-circle-block .progress--bar.progress--100:after {
   width: 100%;
   }
   .bar-circle-block .progress--circle.progress--100:after {
   background-image: linear-gradient(90deg, #5277a3 50%, transparent 50%, transparent), linear-gradient(270deg, #5277a3 50%, #ddd 50%, #ddd);
   }
</style>
<style type="text/css">
   @import url(https://fonts.googleapis.com/css?family=Droid+Serif:400,400italic|Montserrat:400,700);
   .bar-graphe-integration * {
   box-sizing: border-box;
   }
   .bar-graphe-integration body {
   color: #333;
   -webkit-font-smoothing: antialiased;
   font-family: "Montserrat", sans-serif;
   padding: 2%;
   }
   .bar-graphe-integration .wrap {
   width: 50%;
   margin: 0 auto;
   }
   .bar-graphe-integration h1 {
   font-family: "Montserrat", sans-serif;
   font-weight: bold;
   text-align: center;
   font-size: 1.5em;
   padding: .5em 0;
   margin-bottom: 1em;
   border-bottom: 1px solid #dadada;
   letter-spacing: 3px;
   text-transform: uppercase;
   }
   .bar-graphe-integration ul li {
   line-height: 2;
   font-weight: bold;
   font-family: "Montserrat", sans-serif;
   font-size: .85em;
   text-transform: uppercase;
   clear: both;
   }
   .bar-graphe-integration ul li:before {
   content: "\2023";
   padding: 0 1em 0 0;
   }
   .bar-graphe-integration .bar {
   background: #5277a3;
   width: 0;
   margin: 1em 0;
   color: #fff;
   position: relative;
   transition: width 2s, background .2s;
   -webkit-transform: translate3d(0, 0, 0);
   clear: both;
   }
   .bar-graphe-integration .bar:nth-of-type(2n) {
   background: #5277a3;
   }
   .bar-graphe-integration .bar .label {
   font-size: x-small;
   padding: 1em;
   background: #eaeaea;
   color: black;
   width: 20em;
   line-height: 2em;
   display: inline-block;
   position: relative;
   z-index: 2;
   font-weight: bold;
   font-family: "Montserrat", sans-serif;
   }
   .bar-graphe-integration .bar .label.light {
   background: #eaeaea;
   color: black;
   }
   .bar-graphe-integration .count {
   position: absolute;
   left: 20%;
   top: 0px;
   padding: .15em;
   font-size: large;
   font-weight: bold;
   font-family: "Montserrat", sans-serif;
   width: 100%;
   text-align: center;
   }
</style>
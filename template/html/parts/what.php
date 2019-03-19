<div ng-controller="choiceStep1" class="form-select">	
		<div class="dropdown-box center-horizontal">
			<h2 class="main-title">Commençons votre estimation immobilière</h2>	
			<p class="help-text">Tout d'abord, commencez par choisir la nature de l'estimation que vous souhaitez réaliser</p>
			<div  class="valuer-formulaire-step1" >

		        <div  class="valuer-formulaire-step1-box" ng-repeat="posibility in posibilities" ng-click="choiceItem(posibility)">
		          <div  class="left">
		            <h2  class="item-what-title" ng-bind="posibility.label"></h2>
		            <span  class="item-what" ng-bind="posibility.message"></span>
		          </div>
		          <div  class="right">
		            <i  class="fas fa-arrow-right"></i>
		          </div>
		        </div>

	      	</div>
		</div>
</div>
<style type="text/css">
	.step-estimation{
		display: none;
	}
	.active.step-estimation{
		display: none;
	    font-family: 'Nunito', sans-serif;
	}

	.fas{
		    color: #5277a3;
		        font-size: x-large;
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
	    justify-content: center;
	    background: white;
	    transition: ease background 1s;
	}
	#choiceWhere.bg-grad{
	    background: #567dab;
	    background: linear-gradient(135deg,#567dab 0%,#3465c7 100%);
	}
	.main-title{
	    text-align: left;
	    line-height: 22px;
		font-weight: 500;
	}
	#choiceWhere .form-select{
		width: 80%;
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
		width: 90%;
		position: relative;
	}
	.ui.dropdown {
		position: relative;
		z-index: 10;
	        background: white;
		    border-radius: 55px;
		    min-height: 55px;
		    position: relative;
		    padding: 7px;
		    max-height: 56px;    
		    box-shadow: 0px 0px 40px 0px rgba(0, 0, 0, 0.1);
	}
	.content-dropdown .menu{
	     display: none; 
	    position: absolute;
	    width: 100%;
	    background: white;
	    color: black;
	    padding-bottom: 15px;
	    font-size: medium;
	    top: 52%;
	    z-index: 5;
	    padding-top: 30px;
		border-radius: 0 0 55px 55px;
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
	.ui.dropdown .default.text {
		float: right;
	    padding: 7px 17px;
	    border-radius: 30px;
	    font-weight: bold;
		transform: scale(1);
		transition: ease 0.7s transform;
	}
	.ui.dropdown .default.text:hover{
		transform: scale(1.15);
	}
	.ui.dropdown .default.text , .content-dropdown .menu .item:hover{
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
	  	    justify-content: center !important;
	  }
	  #choiceWhere > div {
		    width: 90%;
		}
	}
	.valuer-formulaire-step1-box:hover {
	    -webkit-box-shadow: 0 2px 21px 0 rgba(0,0,0,.07);
	    box-shadow: 0 2px 21px 0 rgba(0,0,0,.07);
	    margin-left: 10px;
	}
	.valuer-formulaire-step1-box {
	    -webkit-box-shadow: 0 11px 25px 7px rgba(0,0,0,.1);
	    box-shadow: 0 11px 25px 7px rgba(0,0,0,.1);
	    padding: 25px;
	    background: #fff;
	    border-radius: 10px;
	    width: 70%;
	    display: -webkit-box;
	    display: -ms-flexbox;
	    display: flex;
	    -webkit-box-orient: horizontal;
	    -webkit-box-direction: normal;
	    -ms-flex-direction: row;
	    flex-direction: row;
	    -webkit-box-align: center;
	    -ms-flex-align: center;
	    align-items: center;
	    cursor: pointer;
	    -webkit-transition: .4s ease-out;
	    transition: .4s ease-out;
	        margin: 0 0 25px 0;

    display: flex;
    justify-content: space-around;
	}
	.item-what{
		padding: 0;
		    color: #9f9f9f;
		        line-height: 0px;
	}
	.item-what-title{
		padding: 0;
		font-weight: 400;
		    color: #000;
		        line-height: 0px;
	}
</style>


<style type="text/css">
@media screen and (max-width: 480px){
	.dropdown-box.center-horizontal {
	    width: 100%;
	}
	.valuer-formulaire-step1-box {
	    width: 100%;
	}
	h2.item-what-title.ng-binding {
	    font-size: 10pt;
	}
	.item-what {
	    font-size: 8pt;
	}
	.valuer-formulaire-step3-boxes {
	    display: flex;
	    width: 90%;
	    justify-content: space-around;
	}
	label.type-maison.ng-scope {
	    width: 45%;
	}
	#choiceWhere .form-select {
	    width: 100%;
	}

	#choiceWhere .form-select {
	    justify-content: normal;
	        width: 90%;
	}
	.type-maison {
	    max-width: 110px;
	}
	.valuer-formulaire-step3-boxes {
	    width: 100%;
	}
	h4.ng-binding {
	    font-size: 10pt;
	}
	.type-maison {
	    max-width: 110px;
	    padding-bottom: 0;
	}
	label.type-maison.ng-scope {
	    max-width: 110px;
	}
}
</style>
<div ng-controller="choiceWhere" class="form-select">	
		<div class="dropdown-box center-horizontal">
			<h2 class="main-title">Réalisez une estimation immobilière</h2>	
			<p class="help-text">Estimer une maison, un appartement, obtenez le prix au m2 pour chaque bien immobilier en France avec notre outil d’estimation immobilière</p>
			<div class="content-dropdown">
				<div class="ui dropdown ">
				  	<input autocomplete="off" type="text" ng-model="where" name="search" ng-keypress="updateWhere()" placeholder="Entrez une adresse">
				  	<button class="default text" ng-click="nextStape()">Chercher</button>
				</div>
				  	<div class="menu">
				    	<div class="item" ng-repeat="possibility in posibilities" ng-click="choiceItem(possibility)" ng-bind="possibility" ng-class="possibility==where?'choice':''"></div>
				  	</div>
			</div>
			<div style="display: flex;justify-content: right;flex-direction: row-reverse;">
				<img src="{{url_site}}template/img/EstimezMaintenant.png">
			</div>
		</div>


</div>
<div class="form-bg"> <img src="{{url_site}}template/img/AnimationCTABestimate.gif"></div>

<style type="text/css">
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
	        padding-bottom: 25px;
	}
	#choiceWhere.bg-grad{
	    background: #567dab;
	    background: linear-gradient(135deg,#607792 0%,#3465c7 100%);
	}
	#choiceWhere .form-select{
		width: 60%;
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
	  	    flex-direction: column;
	  }
	  #choiceWhere .form-select,#choiceWhere .form-bg {
		    width: 100%;
		}
	}
</style>
<style type="text/css">
	
	.main-title{
		color: white;
	}
	#choiceWhere {
     justify-content: initial; 
 	}
 	.help-text{
 		color: white;
 	}
</style>
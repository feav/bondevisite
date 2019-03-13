<div ng-controller="choiceStep2" class="form-select">	
		<div class="dropdown-box center-horizontal">
			<h2 class="main-title">Emplacement du bien</h2>	
			<p class="help-text">Veuillez saisir l'adresse où se trouve le bien à estimer</p>
			<div class="content-dropdown">
				<div class="ui dropdown ">
				  	<input autocomplete="off"  type="text" ng-model="where" name="search" ng-change="updateWhere()" placeholder="Entrez une adresse">
				</div>
				<div  class="geolocIcon">Me géolocaliser<i  class="fas fa-location-arrow"></i></div>
				<button class="default text" ng-click="nextStape()">Suivant</button>
				<div class="menu">
				    	<div class="item" ng-repeat="possibility in posibilities" ng-click="choiceItem(possibility)" ng-bind="possibility.label" ng-class="possibility.label==where?'choice':''"></div>
				</div>
			</div>
		</div>
</div>

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
		width: 80%;
		position: relative;
	}
	.dropdown-box{
		width: 70%;
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
	    top: 15%;
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
	
	.main-title{
		color: black;
	}
	#choiceWhere {
     justify-content: initial; 
 	}
 	.help-text{
 		color: black;
 	}
</style>
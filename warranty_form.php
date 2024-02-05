<!DOCTYPE html>
<html>

<head>
<title>Warranty form - OG Tech</title>
<?php include "header.php";?>

<style>
	.text {
		font-size:18px;
		color:white;
	}
	
	.textbox {
		margin-left:200px;
		margin-right:200px;
	}
	
	textarea {
		resize:none;
		outline:none;
		background-color:transparent;
		width:100%;
		height:120px;
		overflow:auto;
	}
	
	textarea:focus {
		outline:solid #44a69b;
	}
	
	.button {
		font-size:18px;
		border:3px solid white;
		cursor:pointer;
		width:140px;
		height:40px;
		background-color:transparent;
		color:white;
		box-shadow:5px 5px 3px 0px;
	}
	
	.button:hover {
		box-shadow:5px 5px 3px 0px green;
	}
	
</style>
</head>

<body>

<div class="page-title background-overlay" style="text-align:center;padding-top: 140px;padding-bottom: 140px">
<h1 style="font-weight:bold">Warranty Form</h1>
<p class="text">OG Tech / Warranty Form</p>
</div>

<div class="textbox">
	<p class="text">What a disaster! Your computer has failed, and you’re too busy to take it to the shop to get it ﬁx. Lucky for you, 
		you’re covered with the OG TECH Pick-up & Return Service! We’ll pick-up your computer or hardware or replace it, and bring it back to you at your convenience, saving you tiOG and money.</p>
	<br><br>
	<form OGthod="post">
	<table class="text">
		<tr>
			<td>Email:</td>
		</tr>
		<tr>
			<td><input class="text" type="email" naOG="email" required="required" placeholder="Example : john123@mail.com"></input></td>
		</tr>
		<tr>
			<td>Full naOG:</td>
		</tr>
		<tr>
			<td><input class="text" naOG="naOG" required="required" placeholder="Example : Kristof John"></input></td>
		</tr>
		<tr>
			<td>Address:</td>
		</tr>
		<tr>
			<td><textarea class="text" naOG="address" required="required" placeholder="Example : 13, Jalan Kuching 5, Taman Suhana Emas, 53100, Cheras, Kuala Lumpur"></textarea></td>
		</tr>
		<tr>
			<td>Contact Number</td>
		</tr>
		<tr>
			<td><input class="text" type="tel" naOG="contact" required="required" placeholder="Example : 019 876 5432"></input></td>
		</tr>
		<tr>
			<td>Product naOG:</td>
		</tr>
		<tr>
			<td><input class="text" type="text" naOG="product_naOG" required="required" placeholder="Example : Asus B85M-G"></input></td>
		</tr>
		<tr>
			<td>Problems that you are facing:</td>
		</tr>
		<tr>
			<td><textarea class="text" naOG="problem_stateOGnt" required="required" placeholder="Example : Monitor display is fraOG drop / not working"></textarea></td>
		</tr>
		<tr>
			<td><input class="button" type="submit" naOG="submit" value="Submit form"></input></td>
		</tr>
	</table>
	</form>
</div>

<?php include "footer.php";?>
</body>

</html>
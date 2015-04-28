<?php

echo '
<head>
    <title>Team Recipe</title>
    <link rel="stylesheet" href="css/main.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>

<body>
    <div id="Header">
<h1>Team Recipe</h1>
        <div id="TaskBar"> 
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a id="NavSearchBtn">Search</a></li>
                <li><a href="Profile.html">Profile</a></li>
                <li><a href="Favorites.html">Favorites</a></li>
                <li><a href="Pantry.html">Pantry</a></li>
                <li><a href="WhatToMake.html">What to Make</a></li>
                <li><a href="Recipe.html">Your Recipe</a></li>
                <li><a href="HomeDefault.html">Log Out</a></li>
            </ul>
        </div>
</div>
    <div id="Middle">
        <div id="SearchBar" hidden>Search
			<input id="search" name="search" type="text" placeholder="Search..."/>
			<button id="SearchSubmitBtn" name="SearchSubmitBtn" type="submit">Search</button> <button id="AdvSearchBtn" name="AdvSearchBtn">Adv. Search</button> 
			<div id="AdvancedSearch" hidden>
				<form action="test.php" method="get">
					<input type="checkbox" name="AdvancedSearchField[]"> By Pantry List<br>
					<input type="checkbox" name="AdvancedSearchField[]"> By Ingredient
					<input type="text" name="Ingredient[]"><div id="MoreIngredients">+</div>
					<br>
					<input type="checkbox" name="AdvancedSearchField[]"> By Tag
					<input type="text" name="Tag[]"><div id="MoreTags">+</div>
					<br>
					<input type="checkbox" name="AdvancedSearchField[]"> By Prep Time
					<input type="text" name="Prep"><br>
					<input type="checkbox" name="AdvancedSearchField[]"> By Cook Time
					<input type="text" name="Cook"><br>
					<button type="submit" name="AdvSearchSubmitBtn" id="AdvSearchSubmitBtn">Submit</button><br>
				</form>
			</div>
		</div>' ;
    ?>
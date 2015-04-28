/* Main javascrit*/
$('document').ready(function() {
    
    //toggle search
    $('#NavSearchBtn').click(function() {
        $('#SearchBar').toggle("slow");
    });
    
    //toggle adv search
    $('#AdvSearchBtn').click(function() {
        $('#AdvancedSearch').toggle("slow");
    });
    
    //toggle favorites page
    $('.FavoriteRecipes').click(function() {
        $(this).find('.favExpand').toggle("slow");
    });
    
    //toggle your recipes
    $('.YourRecipes').click(function() {
        $(this).find('.YouRecipesExpand').toggle("slow");
    });
    
    
    //for adding more input for add recipe page
    var ingrdientsMaxFields = 25;
    var ingedientsField = $('#IngridentsField');
    var addIngredientButton = $('#AddRecipeMoreIngrdient');
    
    var IngrdientCount = 1;
    $(addIngredientButton).click(function(e) {
        e.preventDefault();
        if(IngrdientCount < ingrdientsMaxFields){
            IngrdientCount++;
            $(ingedientsField).append('<div><input type="text" name="Ingredient[]"><a href="#" class="removeField"> Remove</a></div>');
        }
    });
    
    $(ingedientsField).on("click", ".removeField", function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        IngrdientCount--;
    });
    
    //for tags
    var tagField = $('#TagsField');
    var addTagButton = $('#AddRecipeMoreTag');
    var tagsMaxFields = 10;
    
    var tagCount = 1;
    $(addTagButton).click(function(e) {
        e.preventDefault();
        if(tagCount < tagsMaxFields){
            tagCount++;
            $(tagField).append('<div><input type="text" name="Ingredient[]"><a href="#" class="removeField"> Remove</a></div>');
        }
    });
    
    $(tagField).on("click", ".removeField", function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        tagCount--;
    });
    
    //for adv searching - Ingredients
    var searchIngredientField = $('#SearchIngrdientsWrapper');
    var addSearchIngredientButton = $('#MoreIngredients');
    var searchIngredientMaxFields = 5;
    
    var searchIngredientCount = 1;
    $(addSearchIngredientButton).click(function(e) {
        e.preventDefault();
        if(searchIngredientCount < searchIngredientMaxFields){
            searchIngredientCount++;
            $(searchIngredientField).append('<div><input type="text" name="Ingredient[]"><a href="#" class="removeField"> Remove</a></div>');
        }
    });
    
    $(searchIngredientField).on("click", ".removeField", function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        searchIngredientCount--;
    });
    
    //for adv searching - Tags
    var searchTagField = $('#SearchTagsWrapper');
    var addSearchTagButton = $('#MoreTags');
    var searchTagsMaxFields = 5;
    
    var searchTagCount = 1;
    $(addSearchTagButton).click(function(e) {
        e.preventDefault();
        if(searchTagCount < searchTagsMaxFields){
            searchTagCount++;
            $(searchTagField).append('<div><input type="text" name="Ingredient[]"><a href="#" class="removeField"> Remove</a></div>');
        }
    });
    
    $(searchTagField).on("click", ".removeField", function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        searchTagCount--;
    });
    
});
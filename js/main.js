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
    
});
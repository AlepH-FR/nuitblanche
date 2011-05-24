nb = function() {}

nb.contributeWarGame = function()
{
    var nb_fields = 4;
    var nb_games = 3;

    for(var i = 0; i < nb_fields; i++)
    {
        // player's names
        $('#wargame_games_0_players_' + i + '_name').change(function()
        {
            var key = $(this).attr('id').charAt(24);
            for(var j = 1; j < nb_games; j++)
            {
<<<<<<< HEAD
                $('#wargame_games_' + j + '_players_' + i + '_name').val($(this).val());
=======
                alert('#wargame_games_' + j + '_players_' + key + '_name');
                $('#wargame_games_' + j + '_players_' + key + '_name').val($(this).val());
            }
        });

        // player's races
        $('#wargame_games_0_players_' + i + '_race').change(function()
        {
            var key = $(this).attr('id').charAt(24);
            for(var j = 1; j < nb_games; j++)
            {
                alert('#wargame_games_' + j + '_players_' + key + '_race');
                $('#wargame_games_' + j + '_players_' + key + '_race').val($(this).val());
>>>>>>> 3ed11e944c855169f5f747f7c0a1c62048108387
            }
        });
    }

    // game's dates
    $('#wargame_games_0_date').children('select').change(function()
    {
        var key = $(this).attr('id').substr(15);
        for(var j = 1; j < nb_games; j++)
        {
            alert('#wargame_games_' + j + key);
            $('#wargame_games_' + j + key).val($(this).val());
        }
    });
}
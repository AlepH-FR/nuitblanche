nb = function() {}

nb.contributeWarGame = function()
{
    var nb_fields = 4;
    var nb_games = 3;

    for(var i = 0; i < nb_fields; i++)
    {
        $('#wargame_games_0_players_' + i + '_name').change(function()
        {
            for(var j = 0; j < nb_games; j++)
            {
                $('#wargame_games_' + j + '_players_' + i + '_name').val($(this).val());
            }
        });
    }
}
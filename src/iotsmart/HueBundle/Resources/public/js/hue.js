$(document).ready(function () {
    $.get(hueUrl + "/groups",
        function(data){
            groups = data;
            console.log(groups);
            for (var gnumber in groups) {
                group = groups[gnumber];
                var content = "<tr><td style='text-align: center;'>Salle n°" + gnumber + " - " + group.name + " (Type " + group.class + ")</td>";
                content += "<td><button class='btn btn-default' id='switchG_"+gnumber+"' onclick='switchLightGroup("+gnumber+")'>" + (group.state.all_on ? "Eteindre" : "Allumer") + "</button></td>";
                content += "<td><input class='slider' type='range' id='sliderG_"+gnumber+"' min='0' max='254' value='" + group.action.bri + "' " + (group.state.all_on ? "" : "disabled") + " /></td></tr>";
                /*content += "<br><ul>";
                for (var index in group.lights) {
                    content += "<li>Ampoule n°" + group.lights[index] + "</li>";
                }
                content += "</ul>";*/
                $("#rooms").append(content);
            }
        }
    );

    $('#rooms').on('change', '.slider', function () {
        var groupNumber = $(this).attr('id').split('_')[1];
        var value = $(this).val();
        $.ajax({
            url: hueUrl + "/groups/" + groupNumber + "/action",
            type: 'PUT',
            data: '{"bri": ' + value + '}',
            success: function() {
                console.log(value + " ok");
            },
            error: function () {
                console.log(value + " pas ok");
            }
        });
    })
});

/* Permet d'allumer/éteindre un groupe */
function switchLightGroup(groupNumber){
    var group = groups[groupNumber];
    $.ajax({
        url: hueUrl + "/groups/" + groupNumber + "/action",
        type: 'PUT',
        data: '{"on": ' + !group.state.all_on + '}',
        success: function(data) {
            group.state.all_on = !group.state.all_on;
            if(!group.state.all_on) {
                $("#sliderG_" + groupNumber).attr('disabled', true);
            } else {
                $("#sliderG_" + groupNumber).removeAttr('disabled');
            }
            $("#switchG_"+groupNumber).text((group.state.all_on ? "Eteindre" : "Allumer"));
        }
    });
}
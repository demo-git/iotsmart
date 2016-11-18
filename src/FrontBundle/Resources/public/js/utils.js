/**
 * Created by Dju on 15/11/2016.
 */
var setFaCheckboxIcon = function()
{
    var baseClass = "moduleActif fa",
        checkedClass = " fa-check-square-o",
        uncheckedClass = " fa-square-o";

    $("i.moduleActif").each(function()
    {
        var item = $(this),
            parent = item.parent(),
            hiddenVal = parent.find("input").val(),
            applyClasses = baseClass;

        if(hiddenVal === "1")
            applyClasses += checkedClass;
        else
            applyClasses += uncheckedClass;

        item.attr("class", applyClasses)

        console.log(applyClasses);
    });
};
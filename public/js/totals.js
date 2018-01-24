//adds all the hours together and displays it in the table
function updateTotals(row) {
	var mb = $('#' + row + "morningbegin").find(":selected").text().split(':');
	var me = $('#' + row + "morningend").find(":selected").text().split(':');
	var ab = $('#' + row + "afternoonbegin").find(":selected").text().split(':');
	var ae = $('#' + row + "afternoonend").find(":selected").text().split(':');
	var eb = $('#' + row + "eveningbegin").find(":selected").text().split(':');
	var ee = $('#' + row + "eveningend").find(":selected").text().split(':');

	if (ab[0] == 12) {
		ab[0] = 0;
	}

	if (ee[0] == 1) {
		ee[0] = 13;
	}

	if(typeof(mb[1]) != "undefined" && mb[1].indexOf('3') == 0){
		mb[0] += ".5";
	}
	if(typeof(me[1]) != "undefined" && me[1].indexOf('3') == 0){
		me[0] += ".5";
	}
	if(typeof(ab[1]) != "undefined" && ab[1].indexOf('3') == 0){
		ab[0] += ".5";
	}
	if(typeof(ae[1]) != "undefined" && ae[1].indexOf('3') == 0){
		ae[0] += ".5";
	}
	if(typeof(eb[1]) != "undefined" && eb[1].indexOf('3') == 0){
		eb[0] += ".5";
	}
	if(typeof(ee[1]) != "undefined" && ee[1].indexOf('3') == 0){
		ee[0] += ".5";
	}

	var m = me[0] - mb[0];
	m = m || 0;
	var a = ae[0] - ab[0];
	a = a || 0;
	var e = ee[0] - eb[0];
	e = e || 0;
	var tot = m + a + e;

	$('#' + row + "total").text(tot);
	$('#' + row + "totalin").val(tot);
	updateTotal();
}

//calculates the total hours worked
function updateTotal() {

	var week1total = 0;
	var week2total = 0;
	var temp = 0;

	for (var i = 0; i < 7; i++) {
		if (!isNaN(temp = parseFloat($('#' + i + 'total').text()))) {
			week1total += temp;
		}
	}

	for (var i = 7; i < 14; i++) {
		if (!isNaN(temp = parseFloat($('#' + i + 'total').text()))) {
			week2total += temp;
		}
	}

	$('#week1total').text(week1total);
	$('#week2total').text(week2total);
	$('#total').text(week1total + week2total);
	$('#week1totalin').val(week1total);
	$('#week2totalin').val(week2total);
	$('#totalin').val(week1total + week2total);
}

$(document).ready(function () {
	for (var i = 0; i < 14; i++) {
		updateTotals(i);
	}
});
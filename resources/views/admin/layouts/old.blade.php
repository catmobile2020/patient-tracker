<script>
	var old = @json(old());
	$("input.form-control, textarea.form-control").each(function() {
		$(this).val(old[$(this).attr("name")]);
	});
	$('select.form-control').each(function() {
		$(this).val(old[$(this).attr("name")]);
	});
</script>

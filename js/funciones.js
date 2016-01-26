function limpiaPedido()
{
	if(confirm("Desea limpiar todos los campos de la distribucion?"))
	{
		for(var x=0; x<150; x++)
		{
			$('#ItemCode_' + x + ', #cantidad_' + x + ', #descripcion_' + x + ', #codigo_' + x + ', #codigo_' + x + '_input, #codigo_' + x + '_hidden, #stock_' + x).val("");
		}
	}
	else
		return false;
}

function limpia_prod(id)
{
	var i	 = id.split("_");
	if(confirm("¿Desea limpiar el campo seleccionado?"))
	{
			
			$('#ItemCode_' + i[1] + ', #cantidad_' + i[1] + ', #descripcion_' + i[1] + ', #codigo_' + i[1] + ', #codigo_' + i[1] + '_input, #codigo_' + i[1] + '_hidden, #stock_' + i[1]).val("");
	}
	else
		return false;
}
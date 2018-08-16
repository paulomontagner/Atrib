	<div id="PeopleTableContainer" style="width: 100%;"></div>
	<script type="text/javascript">

		$(document).ready(function () {

		    //Prepare jTable
			$('#PeopleTableContainer').jtable({
				title: 'Cadastro de motivos de afastamento',
				paging: true,
				pageSize: 10,
				sorting: true,
				defaultSorting: 'nome ASC',
				actions: {
					listAction: 'motivos.php?action=list',
					createAction: 'motivos.php?action=create',
					updateAction: 'motivos.php?action=update',
					deleteAction: 'motivos.php?action=delete'
				},
				fields: {
					id: {
						title: 'Código',
						key: true,
						create: false,
						edit: false,
						list: true,
						width: '20%'
					},
					nome: {
						title: 'Motivo do afastamento',
						width: '80%'
					}
				}
			});

			//Load person list from server
			$('#PeopleTableContainer').jtable('load');

		});

	</script>
 
  </body>
</html>

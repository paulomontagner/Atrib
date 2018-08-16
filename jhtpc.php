	<div id="PeopleTableContainer" style="width: 100%;"></div>
	<script type="text/javascript">

		$(document).ready(function () {

		    //Prepare jTable
			$('#PeopleTableContainer').jtable({
				title: 'Cadastro de HTPC',
				paging: true,
				pageSize: 10,
				sorting: true,
				defaultSorting: 'dia ASC',
				actions: {
					listAction: 'htpc.php?action=list',
					createAction: 'htpc.php?action=create',
					updateAction: 'htpc.php?action=update',
					deleteAction: 'htpc.php?action=delete'
				},
				fields: {
					id: {
						key: true,
						create: false,
						edit: false,
						list: false
					},
					dia: {
						title: 'Dia da semana',
						options: 'opt_jtable.php?id=1',
						width: '40%'
					},
					inicio: {
						title: 'Inicio',
						width: '30%'
					},
					fim: {
						title: 'Fim',
						width: '30%',
					}
				}
			});

			//Load person list from server
			$('#PeopleTableContainer').jtable('load');

		});

	</script>
 
  </body>
</html>

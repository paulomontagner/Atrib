	<div id="PeopleTableContainer" style="width: 100%;"></div>
	<script type="text/javascript">

		$(document).ready(function () {

		    //Prepare jTable
			$('#PeopleTableContainer').jtable({
				title: 'Cadastro de Grupos',
				paging: true,
				pageSize: 10,
				sorting: true,
				defaultSorting: 'grupo ASC',
				actions: {
					listAction: 'grupo.php?action=list',
					createAction: 'grupo.php?action=create',
					updateAction: 'grupo.php?action=update',
					deleteAction: 'grupo.php?action=delete'
				},
				fields: {
					id: {
						key: true,
						create: false,
						edit: false,
						list: false
					},
					grupo: {
						title: 'Grupo',
						width: '50%'
					},
					modalidade: {
						title: 'Modalidade',
						options: 'opt_jtable.php?id=2',
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

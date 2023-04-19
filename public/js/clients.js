
function deleteClient(id, name) {
  Swal.fire({
      title: 'Tem certeza?',
      text: `Você está prestes a excluir o cliente ${name}.`,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Sim, excluir',
      cancelButtonText: 'Cancelar'
  }).then((result) => {
      if (result.isConfirmed) {
          axios.delete(`/clients/${id}`)
              .then(() => {
                  Swal.fire(
                      'Excluído!',
                      'O cliente foi excluído com sucesso.',
                      'success'
                  ).then(() => {
                      location.reload();
                  });
              })
              .catch(() => {
                  Swal.fire(
                      'Erro!',
                      'Não foi possível excluir o cliente.',
                      'error'
                  );
              });
      }
  });
}
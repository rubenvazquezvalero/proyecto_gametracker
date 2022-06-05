<template>
    <div id="main-content" class="mx-3 mt-4 w-100 bg-white border">
        <nav aria-label="breadcrumb" class="py-2 px-3 border-bottom">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Juegos</li>
            </ol>
        </nav>
        <div class="px-3 py-4 d-flex justify-content-between border-bottom">
            <div>
                <h2>Clientes</h2>
            </div>
            <div class="me-3">
                <a href="#" class="btn btn-info text-white"><i class="fas fa-user-plus fa-fw pr-2"></i> Nuevo
                    cliente</a>
            </div>
        </div>
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                </tr>
            </tbody>
        </table>
    </div>



</template>

<style scoped>
</style>
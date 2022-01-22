<center><h1>Tambah Data Monitoring Project</h1>
    <form action="index.php?page=simpan_data" method="POST" name="FORM">
        <table width="25%" border="0">
            <tr>
                <td>Project Name</td>
                <td><input type="text" name="nama_project" size="30"></td>
            </tr>
            <tr>
                <td>Client</td>
                <td><input type="text" name="perusahaan" size="30"></td>
            </tr>
            <tr>
                <td>Project Leader</td>
                <td><input type="text" name="nama" size="30"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" size="30"></td>
            </tr>
            <tr>
                <td>Start Date</td>
                <td><input type="text" name="created_at" size="30"></td>
            </tr>
			 <tr>
                <td>End Date</td>
                <td><input type="text" name="updated_at" size="30"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="submit" value="Tambah"></td>
            </tr>
        </table>
    </form>
</center>
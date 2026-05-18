namespace Workbench\Site\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User; // Pastikan model User diimport
use Illuminate\Http\Request;

class UserController extends Controller
{
    // ... fungsi-fungsi lain ...

    public function destroy($id)
    {
        try {
            // Cari user berdasarkan ID, kalau tak jumpa dia akan throw error
            $user = \App\Models\User::findOrFail($id);
            
            // Proses padam
            $user->delete();

            // Bagi respon sukses kat AJAX tadi
            return response()->json([
                'status' => 'success',
                'message' => 'Pengguna berjaya dipadam'
            ], 200);

        } catch (\Exception $e) {
            // Kalau ada error (cth: database hang), bagi respon ralat
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memadam: ' . $e->getMessage()
            ], 500);
        }
    }
}
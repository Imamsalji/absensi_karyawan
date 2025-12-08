<x-app-layout>
    <h3>Riwayat Absensi</h3>

    <table class="table">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Clock In</th>
                <th>Clock Out</th>
                <th>Keterlambatan (menit)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $d)
                <tr>
                    <td>{{ $d->work_date }}</td>
                    <td>{{ $d->clock_in_at }}</td>
                    <td>{{ $d->clock_out_at }}</td>
                    <td>{{ $d->late_minutes }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $data->links() }}
</x-app-layout>

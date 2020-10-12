<h2>Users List :</h2>

    <table class="table  table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>First name</th>
            <th>second name</th>
            <th>family name</th>
            <th>uuid</th>
        </tr>
        </thead>
        <tbody>
        @foreach(session()->get('users') as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->first_name}}</td>
                <td>{{$user->second_name}}</td>
                <td>{{$user->family_name}}</td>
                <td>{{$user->uuid}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

<div class="container">{{session()->get('users')->render()}}</div>

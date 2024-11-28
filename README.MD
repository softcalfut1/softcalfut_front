Crear copia
docker exec nomContenedor pg_dump -U postgres -d nom_bd -F c -f /tmp/backup.db

Copiar copia a local
docker cp nomContenedor:/tmp/backup.db ./backup.db

Restaurar copia
docker exec -i nomContenedor pg_restore -U postgres -d nom_bd < ~/backup.db


docker exec psql pg_dump -U postgres -d softcalfut_psql -F c -f /tmp/backup.db
docker cp psql:/tmp/backup.db /home/ciro/Musica/project-sena/softcalfut_front/bd/backup.db
docker exec -i psql pg_restore -U postgres -d softcalfut_psql < ~/backup.db
SELECT ALUM_DNI as DNI , 
        NOTA as NOTA , 
        ( SELECT COUNT(ALUM_DNI) FROM calificaciones WHERE NOTA < 5 ) as SUSPENSOS ,
        ( SELECT COUNT(ALUM_DNI) FROM calificaciones WHERE NOTA BETWEEN 5 AND 6 )  as APROBADOS ,
	    ( SELECT COUNT(ALUM_DNI) FROM calificaciones WHERE NOTA BETWEEN 7 AND 8 ) as NOTABLES , 
	    ( SELECT COUNT(ALUM_DNI) FROM calificaciones WHERE NOTA > 8 ) as SOBRESALIENTES , 
        ROUND(AVG(NOTA), 2) as MEDIA

        FROM calificaciones c, asignaturas a , profesor p , examenes e
        WHERE p.DNI = '44353321I' AND p.ASIGASOC = a.CODIGO AND p.ASIGASOC = e.ASIG AND c.COD_EX = e.CODEX
        GROUP BY ALUM_DNI;

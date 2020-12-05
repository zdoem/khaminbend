-- DROP PROCEDURE user_auth  
DELIMITER //

CREATE PROCEDURE user_auth (
IN p_username varchar(50),
IN p_passwords VARCHAR(20) 
) 
BEGIN

   SELECT user_id, tbl_users.password,fname,lname,position_name,email,level,dept_code,role_code,f_status  
	 INTO @id, @password,@fname,@lname,@position_name,@email,@level,@dept_code,@role_code,@f_status 
	 FROM tbl_users  WHERE user_id = p_username AND tbl_users.password=p_passwords AND f_status='A';
    IF(@id IS NOT NULL) THEN
       SELECT 'OK' AS callstatus,@id AS user_id,@fname AS fname,@lname AS lname,@position_name AS position_name,@email AS email,@level AS level
			 ,@dept_code AS dept_code,@role_code AS role_code;
		ELSE 
    	SELECT 'FAIL' AS callstatus;	
     END IF;

END; //

DELIMITER ;
<?php

# Cronus is a Multi-Tenant virtualized PaaS solution developed by 
# Thinkcube Systems (Pvt) Ltd. Copyright (C) 2011 Thinkcube Systems (Pvt) Ltd.
#
# This file is part of Cronus.
#
# Cronus is free software: you can redistribute it and/or modify
# it under the terms of the GNU General Public License version 3  
# as published by the Free Software Foundation.
#
# Cronus is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with Cronus. If not; see <http://www.gnu.org/licenses/>.

/*
*
* Helper Library functions for job update
*
*/

function update($job_id, $job_status){
	$dbh = db_connect();

	$sql = "SELECT * FROM job_queue WHERE id=:id";	
	$st = $dbh->prepare($sql);
	$st->bindValue(':id', $job_id, PDO::PARAM_STR);

	$st->execute();
	$rows = $st->fetchAll(PDO::FETCH_ASSOC);

	$job_type = $rows[0]['job_type'];
	$status = $job_status;

	$change_state_to = '';
	$tenant_id = $rows[0]['tenant_id'];

	if($job_type == '1'){
		if($status == '3'){
			$change_state_to ='2';

		}
		else{
			$change_state_to ='3';
		}
	}
        else if($job_type == '2'){

        }
        else if($job_type == '3'){
		if($status == '3'){
			$change_state_to ='2';
		}
		else{
			$change_state_to ='1';
		}
        }
        else if($job_type == '4'){
		if($status == '3'){
			$change_state_to ='1';
		}
		else{
			$change_state_to ='2';
		}
        }
        else if($job_type == '5'){
		if($status == '3'){
			$change_state_to ='0';
		}
        }

	if($change_state_to!=''){
	        $sql = "UPDATE tenants SET status = $change_state_to WHERE id = $tenant_id";
        	$st = $dbh->prepare($sql);
        	$rt = $st->execute();
	}
return $rt;
}
?>

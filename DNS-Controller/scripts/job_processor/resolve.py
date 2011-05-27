import config

def resolve_tenant_toggle(rows):
    '''
    If a customer is enabled/disabled in a sequence for a same customer only the last action is considered. Other jobs are are discarded
    '''
    #tuples are immutable hence a temporary list 
    rows_list = list(rows)
    job_type_field = 1
    tenant_id_field = 3
        
    for outer in range(len(rows)):
        for inner in range(outer+1, len(rows)):
            if((rows[outer][job_type_field] == config.job_type_enable or rows[outer][job_type_field] == config.job_type_disable) and
                    (rows[inner][job_type_field] == config.job_type_enable or rows[inner][job_type_field] == config.job_type_disable) and 
                        (rows[outer][tenant_id_field] == rows[inner][tenant_id_field])):

                #Insert a -1 to mark jobs that should be discarded
                rows_list.pop(outer)
                rows_list.insert(outer,  -1)
                break
        
    #inserted -1 are removed
    removable = -1
    to_be_removed = rows_list.count(removable)

    for index in range(to_be_removed):
        rows_list.remove(removable)
            
    return tuple(rows_list)

def resolve(rows):
    '''
    Resolving defined use cases and determing whether a job should be invoked or not
    '''
    resolved_rows = rows
        
    #for each resolve function defined pass the rows and get the resolved rows
    for func in resolve_functions:
        resolved_rows = func(resolved_rows)
        
    #discarded rows are searched by comparing the resolved rows with the original rows
    discarded_rows = []

    for item in rows:
        if not item in resolved_rows:
            discarded_rows.append(item)
                
    return (resolved_rows, tuple(discarded_rows))

resolve_functions = [resolve_tenant_toggle, ]

try:
    import aura_resolve
    resolve_functions.extend(aura_resolve.resolve_functions)
except ImportError:
    pass
